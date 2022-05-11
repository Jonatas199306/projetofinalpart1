<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\User;

class PermissionsAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Resetar cache roles e permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Criar permissions
        $permissions = [
            'dashboard',
            'administrador',
            'adicionais',
            'controle',
            'cadastros',
            'seguranca',
            'suporte',
            'usuarios-index',
            'usuarios-cadastrar',
            'usuarios-deletar',
            'usuarios-editar',
            'grupos-index',
            'grupos-cadastrar',
            'grupos-deletar',
            'grupos-editar',
            'afiliadas-index',
            'afiliadas-cadastrar',
            'afiliadas-deletar',
            'afiliadas-editar',
            'associados-index',
            'associados-cadastrar',
            'associados-deletar',
            'associados-editar',
            'afiliadas-tipos-index',
            'afiliadas-tipos-cadastrar',
            'afiliadas-tipos-deletar',
            'afiliadas-tipos-editar',
            'bancos-index',
            'bancos-cadastrar',
            'bancos-deletar',
            'bancos-editar',
            'afiliadas-contatos-index',
            'afiliadas-contatos-cadastrar',
            'afiliadas-contatos-deletar',
            'afiliadas-contatos-editar',
            'contas-bancarias-index',
            'contas-bancarias-cadastrar',
            'contas-bancarias-deletar',
            'contas-bancarias-editar',
            'combinacoes-index',
            'remessa-index',
            'repasse_retorno-index',
            'fechamento-index',
            'autorizacoes-index',
            'contatos-index',
            'repasse-index',
            'retorno-index'
         ];


          foreach ($permissions as $permission) {
              Permission::updateOrCreate(['name' => $permission]);
          }

         // CRIAR GRUPOS(ROLES) E ATRIBUIR AOS PERMISSIONS
            $admin_rule = Role::create(['name' => 'Admin']);
            foreach ($permissions as $permission) {
                //Exemplo: $role1->givePermissionTo('edit articles');
                $admin_rule->givePermissionTo($permission);
            }


            //Criar Admin e Associar ao Grupo ADMIN
            $user = User::create([
                'name' => 'Administrador',
                'email' => 'admin@gvwebsolution.com',
                'password'  => bcrypt('sk8namao')
            ]);
            $user->assignRole($admin_rule);

    }
}
