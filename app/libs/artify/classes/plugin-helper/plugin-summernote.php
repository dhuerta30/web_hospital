<script type="text/javascript">
    jQuery(document).on("artify_on_load artify_after_submission artify_after_ajax_action", function (event, container) {

        function cleanText(text) {
            return text
                .replace(/\uFEFF/g, '')   // BOM / zero-width no-break space (el que partía "para")
                .replace(/\u200B/g, '')   // zero-width space
                .replace(/\u00AD/g, '')   // soft hyphen (guion de Word)
                .replace(/\r\n/g, '\n');  // normaliza saltos de línea
        }

        jQuery("<?php echo $elementName; ?>").summernote({
                buttons: {
                    myPicture: function (context) {
                    var ui = $.summernote.ui;
                    var button = ui.button({
                        contents: '<i class="note-icon-picture"></i> Mi Imagen',
                        tooltip: 'Insertar Imagen',
                        click: function () {
                        var fileInput = $('<input type="file" accept="image/*">');
                        fileInput.click();
                        fileInput.on('change', function () {
                            var file = this.files[0];
                            if (file) {
                                var formData = new FormData();
                                formData.append("file", file);
                            }
                        });
                        }
                    });
                    return button.render();
                    }
                },
                callbacks: {
                    onPaste: function (e) {
                        // Toma SOLO el texto plano del portapapeles (sin fuentes ni estilos de Word/web)
                        var bufferText = (e.originalEvent.clipboardData || window.clipboardData).getData('Text');
                        e.preventDefault();
                        // Limpia caracteres invisibles antes de insertar
                        bufferText = cleanText(bufferText);
                        // Inserta el texto respetando el estilo uniforme del editor
                        document.execCommand('insertText', false, bufferText);
                    },
                    onDrop: function (e) {
                        // Bloquea el drag & drop de texto/HTML con formato de Word
                        var dataTransfer = e.originalEvent.dataTransfer;
                        if (dataTransfer && dataTransfer.getData('text/plain')) {
                            e.preventDefault();
                            var droppedText = cleanText(dataTransfer.getData('text/plain'));
                            document.execCommand('insertText', false, droppedText);
                        }
                    },
                    onChange: function(contents, $editable) {
                        let editor = jQuery("<?php echo $elementName; ?>").next('.note-editor');

                        // Envuelve imágenes sueltas en <a> con fancybox (tu lógica original intacta)
                        let imgs = editor.find('img');
                        imgs.each(function() {
                            let $img = jQuery(this);
                            if (!$img.parent().is("a")) {
                                let src = $img.attr("src");
                                let $a = jQuery('<a>', {
                                    href: src,
                                    "data-fancybox": "gallery",
                                    "data-caption": $img.attr("alt") || "Foto"
                                });
                                $img.attr("width", "150");
                                $img.wrap($a);
                            }
                        });

                        // Elimina atributos style/font/lang residuales que a veces
                        // se cuelan en spans pegados desde Word aunque no sea vía onPaste
                        editor.find('.note-editable span[style], .note-editable font').each(function() {
                            let $el = jQuery(this);
                            $el.removeAttr('style').removeAttr('lang').removeAttr('face');
                        });
                    }
                }
                <?php
                if (isset($params))
                    echo implode(', ', array_map(
                                    function ($v, $k) {
                                return $k . ':' . $v;
                            }, $params, array_keys($params)
                    ));
                ?>
        });
    });
</script>