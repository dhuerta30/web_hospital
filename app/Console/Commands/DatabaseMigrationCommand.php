<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Schema\Table;
use Doctrine\DBAL\Schema\SchemaException;

class DatabaseMigrationCommand extends Command
{
    protected static $defaultName = 'database:migrate';

    private Connection $connection;

    public function __construct(Connection $connection)
    {
        parent::__construct();
        $this->connection = $connection;
    }

    protected function configure()
    {
        $this->setDescription(
            'Ejecuta las migraciones de base de datos (php arco database:migrate)'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $schemaManager = $this->connection->createSchemaManager();

        // Migraciones
        $this->createAnidadaTable($schemaManager, $output);
        $this->createMenuTable($schemaManager, $output);
        $this->createSubmenuTable($schemaManager, $output);
        $this->createUsuarioTable($schemaManager, $output);
        $this->createUsuarioMenuTable($schemaManager, $output);
        $this->createUsuarioSubmenuTable($schemaManager, $output);
        $this->createModulosTable($schemaManager, $output);

        $output->writeln('<info>✔ Migraciones completadas.</info>');
        return Command::SUCCESS;
    }

    /* =====================================================
     * TABLA: anidada
     * ===================================================== */
    private function createAnidadaTable($schemaManager, OutputInterface $output): void
    {
        $tableName = 'anidada';

        try {
            if (in_array($tableName, $schemaManager->listTableNames())) {
                $output->writeln("ℹ La tabla <comment>$tableName</comment> ya existe.");
                return;
            }

            $output->writeln("Creando tabla <info>$tableName</info>...");

            $table = new Table($tableName);

            $table->addColumn('id_tabla_anidada', 'integer', [
                'autoincrement' => true,
                'unsigned' => true
            ]);

            $table->addColumn('id_modulos', 'integer', ['unsigned' => true, 'notnull' => false]);
            $table->addColumn('nivel_db', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('tabla_db', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('consulta_crear_tabla', 'text', ['notnull' => false]);
            $table->addColumn('template_fields_db', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('active_filter_db', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('clone_row_db', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('active_popup_db', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('active_search_db', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('activate_deleteMultipleBtn_db', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('button_add_db', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('actions_buttons_grid_db', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('activate_nested_table_db', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('buttons_actions_db', 'string', ['length' => 100, 'notnull' => false]);

            $table->setPrimaryKey(['id_tabla_anidada']);

            $schemaManager->createTable($table);

            $output->writeln("✔ Tabla <info>$tableName</info> creada.");
        } catch (SchemaException $e) {
            $output->writeln("<error>Error en $tableName: {$e->getMessage()}</error>");
        }
    }

    /* =====================================================
     * TABLA: menu
     * ===================================================== */
    private function createMenuTable($schemaManager, OutputInterface $output): void
    {
        $tableName = 'menu';

        try {
            if (in_array($tableName, $schemaManager->listTableNames())) {
                $output->writeln("ℹ La tabla <comment>$tableName</comment> ya existe.");
                return;
            }

            $output->writeln("Creando tabla <info>$tableName</info>...");

            $table = new Table($tableName);

            $table->addColumn('id_menu', 'integer', [
                'autoincrement' => true,
                'unsigned' => true
            ]);

            $table->addColumn('nombre_menu', 'string', ['length' => 100]);
            $table->addColumn('url_menu', 'string', ['length' => 300]);
            $table->addColumn('icono_menu', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('submenu', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('orden_menu', 'smallint', ['notnull' => false]);
            $table->addColumn('area_protegida_menu', 'string', ['length' => 100, 'notnull' => false]);

            $table->setPrimaryKey(['id_menu']);

            $schemaManager->createTable($table);

            $output->writeln("✔ Tabla <info>$tableName</info> creada.");
        } catch (SchemaException $e) {
            $output->writeln("<error>Error en $tableName: {$e->getMessage()}</error>");
        }
    }

    private function createSubmenuTable($schemaManager, OutputInterface $output): void 
    {
        $tableName = 'submenu';

        try {
            if (in_array($tableName, $schemaManager->listTableNames())) {
                $output->writeln("ℹ La tabla <comment>$tableName</comment> ya existe.");
                return;
            }

            $output->writeln("Creando tabla <info>$tableName</info>...");

            $table = new Table($tableName);

            $table->addColumn('id_submenu', 'integer', [
                'autoincrement' => true,
                'unsigned' => true
            ]);

            $table->addColumn('id_menu', 'integer', ['unsigned' => true, 'notnull' => false]);
            $table->addColumn('nombre_submenu', 'string', ['length' => 100]);
            $table->addColumn('url_submenu', 'string', ['length' => 300]);
            $table->addColumn('icono_submenu', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('orden_submenu', 'smallint', ['notnull' => false]);
            $table->addColumn('area_protegida_submenu', 'string', ['length' => 100, 'notnull' => false]);

            $table->setPrimaryKey(['id_submenu']);

            $schemaManager->createTable($table);

            $output->writeln("✔ Tabla <info>$tableName</info> creada.");
        } catch (SchemaException $e) {
            $output->writeln("<error>Error en $tableName: {$e->getMessage()}</error>");
        }
    }

    private function createUsuarioTable($schemaManager, OutputInterface $output): void
    {
        $tableName = 'usuario';

        try {
            if (in_array($tableName, $schemaManager->listTableNames())) {
                $output->writeln("ℹ La tabla <comment>$tableName</comment> ya existe.");
                return;
            }

            $output->writeln("Creando tabla <info>$tableName</info>...");

            $table = new Table($tableName);

            $table->addColumn('id', 'integer', [
                'autoincrement' => true,
                'unsigned' => true
            ]);

            $table->addColumn('nombre', 'string', ['length' => 50]);
            $table->addColumn('email', 'string', ['length' => 200]);
            $table->addColumn('usuario', 'string', [
                'length' => 15,
                'notnull' => false
            ]);
            $table->addColumn('password', 'string', [
                'length' => 200,
                'notnull' => false
            ]);
            $table->addColumn('token', 'text', ['notnull' => false]);
            $table->addColumn('token_api', 'text', ['notnull' => false]);
            $table->addColumn('idrol', 'integer', [
                'unsigned' => true,
                'notnull' => false
            ]);
            $table->addColumn('status', 'integer', [
                'unsigned' => true,
                'notnull' => false
            ]);
            $table->addColumn('avatar', 'string', [
                'length' => 300,
                'notnull' => false
            ]);

            $table->setPrimaryKey(['id']);

            // Índices recomendados
            $table->addUniqueIndex(['email'], 'uniq_usuario_email');
            $table->addUniqueIndex(['usuario'], 'uniq_usuario_usuario');

            $schemaManager->createTable($table);

            $output->writeln("✔ Tabla <info>$tableName</info> creada.");
        } catch (SchemaException $e) {
            $output->writeln("<error>Error en $tableName: {$e->getMessage()}</error>");
        }
    }

    private function createUsuarioMenuTable($schemaManager, OutputInterface $output): void
    {
        $tableName = 'usuario_menu';

        try {
            if (in_array($tableName, $schemaManager->listTableNames())) {
                $output->writeln("ℹ La tabla <comment>$tableName</comment> ya existe.");
                return;
            }

            $output->writeln("Creando tabla <info>$tableName</info>...");

            $table = new Table($tableName);

            $table->addColumn('id_usuario_menu', 'integer', [
                'autoincrement' => true,
                'unsigned' => true
            ]);

            $table->addColumn('id_usuario', 'integer', [
                'unsigned' => true,
                'notnull' => false
            ]);
            $table->addColumn('id_menu', 'integer', [
                'unsigned' => true,
                'notnull' => false
            ]);
            $table->addColumn('visibilidad_menu', 'string', ['length' => 100]);
    
            $table->setPrimaryKey(['id_usuario_menu']);

            $schemaManager->createTable($table);

            $output->writeln("✔ Tabla <info>$tableName</info> creada.");
        } catch (SchemaException $e) {
            $output->writeln("<error>Error en $tableName: {$e->getMessage()}</error>");
        }
    }

    private function createUsuarioSubmenuTable($schemaManager, OutputInterface $output): void
    {
        $tableName = 'usuario_submenu';

        try {
            if (in_array($tableName, $schemaManager->listTableNames())) {
                $output->writeln("ℹ La tabla <comment>$tableName</comment> ya existe.");
                return;
            }

            $output->writeln("Creando tabla <info>$tableName</info>...");

            $table = new Table($tableName);

            $table->addColumn('id_usuario_submenu', 'integer', [
                'autoincrement' => true,
                'unsigned' => true
            ]);

            $table->addColumn('id_submenu', 'integer', [
                'unsigned' => true,
                'notnull' => false
            ]);
            $table->addColumn('id_menu', 'integer', [
                'unsigned' => true,
                'notnull' => false
            ]);
            $table->addColumn('visibilidad_submenu', 'string', ['length' => 100]);

            $table->addColumn('id_usuario', 'integer', [
                'unsigned' => true,
                'notnull' => false
            ]);
    
            $table->setPrimaryKey(['id_usuario_submenu']);

            $schemaManager->createTable($table);

            $output->writeln("✔ Tabla <info>$tableName</info> creada.");
        } catch (SchemaException $e) {
            $output->writeln("<error>Error en $tableName: {$e->getMessage()}</error>");
        }
    }

    private function createModulosTable($schemaManager, OutputInterface $output): void
    {
        $tableName = 'modulos';

        try {
            if (in_array($tableName, $schemaManager->listTableNames())) {
                $output->writeln("ℹ La tabla <comment>$tableName</comment> ya existe.");
                return;
            }

            $output->writeln("Creando tabla <info>$tableName</info>...");

            $table = new Table($tableName);

            // PK
            $table->addColumn('id_modulos', 'integer', [
                'autoincrement' => true,
                'unsigned' => true
            ]);

            // Campos VARCHAR / TEXT según imagen
            $table->addColumn('tabla', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('id_tabla', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('crud_type', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('query', 'text', ['notnull' => false]);
            $table->addColumn('controller_name', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('columns_table', 'text', ['notnull' => false]);
            $table->addColumn('name_view', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('add_menu', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('template_fields', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('id_menu', 'integer', ['notnull' => false, 'unsigned' => true]);
            $table->addColumn('active_filter', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('clone_row', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('active_popup', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('active_search', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('activate_deleteMultipleBtn', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('button_add', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('actions_buttons_grid', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('modify_query', 'text', ['notnull' => false]);
            $table->addColumn('activate_nested_table', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('buttons_actions', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('logo_pdf', 'string', ['length' => 300, 'notnull' => false]);
            $table->addColumn('marca_de_agua_pdf', 'string', ['length' => 300, 'notnull' => false]);
            $table->addColumn('activate_pdf', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('refrescar_grilla', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('consulta_pdf', 'text', ['notnull' => false]);
            $table->addColumn('id_campos_insertar', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('encryption', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('mostrar_campos_busqueda', 'string', ['length' => 300, 'notnull' => false]);
            $table->addColumn('mostrar_columnas_grilla', 'string', ['length' => 300, 'notnull' => false]);
            $table->addColumn('mostrar_campos_formulario', 'string', ['length' => 300, 'notnull' => false]);
            $table->addColumn('activar_recaptcha', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('sitekey_recaptcha', 'string', ['length' => 500, 'notnull' => false]);
            $table->addColumn('sitesecret_recaptcha', 'string', ['length' => 500, 'notnull' => false]);
            $table->addColumn('mostrar_campos_filtro', 'string', ['length' => 300, 'notnull' => false]);
            $table->addColumn('activar_autosugerencias', 'string', ['length' => 300, 'notnull' => false]);
            $table->addColumn('campos_no_requeridos', 'string', ['length' => 300, 'notnull' => false]);
            $table->addColumn('nombre_modulo', 'string', ['length' => 300, 'notnull' => false]);
            $table->addColumn('tipo_de_filtro', 'text', ['notnull' => false]);
            $table->addColumn('function_filter_and_search', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('activar_union_interna', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('mostrar_campos_formulario_editar', 'string', ['length' => 300, 'notnull' => false]);
            $table->addColumn('posicion_botones_accion_grilla', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('campos_requeridos', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('mostrar_columna_acciones_grilla', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('mostrar_paginacion', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('activar_numeracion_columnas', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('activar_registros_por_pagina', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('cantidad_de_registros_por_pagina', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('activar_edicion_en_linea', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('ordenar_grilla_por', 'string', ['length' => 500, 'notnull' => false]);
            $table->addColumn('tipo_orden', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('posicionarse_en_la_pagina', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('nombre_columnas', 'text', ['notnull' => false]);
            $table->addColumn('nuevo_nombre_columnas', 'text', ['notnull' => false]);
            $table->addColumn('ocultar_id_tabla', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('nombre_campos', 'text', ['notnull' => false]);
            $table->addColumn('nuevo_nombre_campos', 'text', ['notnull' => false]);
            $table->addColumn('totalRecordsInfo', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('area_protegida_por_login', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('tabla_principal_union', 'string', ['length' => 500, 'notnull' => false]);
            $table->addColumn('tabla_secundaria_union', 'string', ['length' => 500, 'notnull' => false]);
            $table->addColumn('campos_relacion_union_tabla_principal', 'text', ['notnull' => false]);
            $table->addColumn('campos_relacion_union_tabla_secundaria', 'text', ['notnull' => false]);
            $table->addColumn('posicion_filtro', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('file_callback', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('type_callback', 'text', ['notnull' => false]);
            $table->addColumn('type_fields', 'text', ['notnull' => false]);
            $table->addColumn('text_no_data', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('type_union', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('send_email', 'string', ['length' => 100, 'notnull' => false]);
            $table->addColumn('ocultar_label', 'string', ['length' => 300, 'notnull' => false]);
            $table->addColumn('valor_predeterminado_de_campo', 'string', ['length' => 300, 'notnull' => false]);
            $table->addColumn('sitesecret_repatcha', 'string', ['length' => 300, 'notnull' => false]);
            $table->addColumn('activar_union_izquierda', 'string', ['length' => 300, 'notnull' => false]);
            $table->addColumn('tabla_principal_union_izquierda', 'string', ['length' => 300, 'notnull' => false]);
            $table->addColumn('tabla_secundaria_union_izquierda', 'string', ['length' => 300, 'notnull' => false]);
            $table->addColumn('campos_relacion_union_tabla_secundaria_izquierda', 'string', ['length' => 300, 'notnull' => false]);
            $table->addColumn('campos_relacion_union_tabla_principal_izquierda', 'string', ['length' => 300, 'notnull' => false]);
            $table->addColumn('campos_relacion_union_tabla_secondary', 'text', ['length' => 4294967295, 'notnull' => false]);

            // Primary key
            $table->setPrimaryKey(['id_modulos']);

            $schemaManager->createTable($table);

            $output->writeln("✔ Tabla <info>$tableName</info> creada.");
        } catch (SchemaException $e) {
            $output->writeln("<error>Error en $tableName: {$e->getMessage()}</error>");
        }
    }
}
