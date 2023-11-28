<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//agregamos el modelo de permisos de spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            //Operaciones sobre tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            //Operacions sobre tabla blogs
             'ver-registro',
             'crear-registro',
             'editar-registro',
             'borrar-registro',

              //Operacions sobre tabla blogs
              'ver-plan-mejoras',
              'crear-plan-mejoras',
              'editar-plan-mejoras',
              'borrar-plan-mejoras',

              //Operacions sobre tabla blogs
              'ver-seguimiento-plan-mejoras',
              'crear-seguimiento-plan-mejoras',
              'editar-seguimiento-plan-mejoras',
              'borrar-seguimiento-plan-mejoras'
        ];

        foreach($permisos as $permiso) {
            Permission::create(['name'=>$permiso]);
        }
    }
}
