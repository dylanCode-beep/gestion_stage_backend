<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    
    public function run(): void
    {
        $permissions = 
        [
            // admin
            'ajouter stagiaire',
            'modifier stagiaire',
            'supprimer stagiaire',
            'ajouter encandreur',
            'modifier encadreur',
            'supprimer encadreur',
            'ajouter cellule',
            'modifier cellule',
            'supprimer un cellule',
            'affecter encadreur a une cellule',
            'consulter rapport stagiaire',
            'valider theme',
            'valider rapport',
            'consulter rapport',
            // stagiaire
            'publier son theme',
            'modifier son theme',
            'supprimer son theme',
            'publier son rapport',
            
        ];

        foreach ($permissions as $permissions) {
            Permission::findOrCreate($permissions);
        }

        $admin = Role::firstOrCreate(['name'=> 'admin']);
        $encadreur = Role::firstOrCreate(['name'=>'encadreur']);
        $stagiaire = Role::firstOrCreate(['name'=>'stagiaire']);

        $admin->syncPermissions(Permission::all());
        $encadreur->syncPermissions([
            'consulter rapport stagiaire',
            'valider theme',
            'valider rapport',
            'consulter rapport'
        ]);
        $stagiaire->syncPermissions([
            'publier son rapport',
            'publier son theme',
            'modifier son theme',
            'supprimer son theme'
        ]);
    }
}
