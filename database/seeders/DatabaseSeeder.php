<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => '12345', 
            'role' => 'admin', 
        ]);

        \App\Models\User::create([
            'name' => 'Edson Arturo Ibarra Moreno',
            'email' => 'chef@example.com',
            'password' => '12345', 
            'role' => 'chef', 
        ]);

        \App\Models\User::create([
            'name' => 'Hector Manuel',
            'email' => 'user@example.com',
            'password' => '12345', 
            'role' => 'user', 
        ]);

        \App\Models\Receta::create([
            'nombre'=>'Ensalada Cesar',
            'descripcion'=>'La Ensalada César de Pollo es una ensalada abundante y satisfactoria que combina hojas de lechuga fresca, croutones crujientes, queso parmesano rallado y trozos de pollo a la parrilla, todo ello cubierto con una sabrosa salsa César.',
            'id_chef'=>'2'
        ]);

        \App\Models\Ingrediente::create([
            'id_receta'=>'1',
            'Descripcion'=>'Pechugas de pollo'
        ]);

        \App\Models\Ingrediente::create([
            'id_receta'=>'1',
            'Descripcion'=>'Hojas de lechuga romana o lechuga iceberg'
        ]);

        
        \App\Models\Ingrediente::create([
            'id_receta'=>'1',
            'Descripcion'=>'Aceite de oliva'
        ]);

        \App\Models\Ingrediente::create([
            'id_receta'=>'1',
            'Descripcion'=>'Ajo picado'
        ]);

        \App\Models\Ingrediente::create([
            'id_receta'=>'1',
            'Descripcion'=>'Queso parmesano rallado'
        ]);

        \App\Models\Paso::create([
            'id_receta'=>'1',
            'numero'=>'1',
            'descripcion'=>'Sazona las pechugas de pollo con sal y pimienta al gusto.'
        ]);

        \App\Models\Paso::create([
            'id_receta'=>'1',
            'numero'=>'2',
            'descripcion'=>'Calienta una sartén a fuego medio-alto y cocina las pechugas de pollo hasta que estén bien cocidas y doradas por ambos lados, aproximadamente de 6 a 8 minutos por cada lado, dependiendo del grosor de las pechugas. Una vez cocido, deja que el pollo descanse unos minutos antes de cortarlo en trozos.'
        ]);


        \App\Models\Paso::create([
            'id_receta'=>'1',
            'numero'=>'3',
            'descripcion'=>'Lava y seca las hojas de lechuga y colócalas en un bol grande'
        ]);

        
        \App\Models\Paso::create([
            'id_receta'=>'1',
            'numero'=>'4',
            'descripcion'=>'Agrega los croutones, el pollo cortado en trozos y el queso parmesano rallado por encima.'
        ]);
                
        \App\Models\Paso::create([
            'id_receta'=>'1',
            'numero'=>'5',
            'descripcion'=>'Vierte la salsa César sobre la ensalada y mezcla todo suavemente para asegurarte de que todos los ingredientes estén bien cubiertos con la salsa.'
        ]);

        \App\Models\Paso::create([
            'id_receta'=>'1',
            'numero'=>'6',
            'descripcion'=>'Sirve la Ensalada César de Pollo en platos individuales y disfruta de esta deliciosa y clásica ensalada. ¡Buen provecho!'
        ]);
    }
}
