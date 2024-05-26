<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Paso;
use \App\Models\Receta;
use \App\Models\Ingrediente;

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
            'id_chef'=>'2',
            'img_url'=>'https://th.bing.com/th/id/R.0e47bea21234f8bfce32028f101ba5c1?rik=9py2KaDirMXRug&pid=ImgRaw&r=0',
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

        $receta1 = Receta::create([
            'nombre' => 'Spaghetti a la Bolognesa',
            'descripcion' => 'Spaghetti con una salsa de tomate casera y carne molida.',
            'id_chef' => 1,
            'img_url'=>'https://th.bing.com/th/id/R.cf34350301b2522de13b76ae2106a0c5?rik=kA4EsmJkP6m4zw&pid=ImgRaw&r=0',
        ]);

        Ingrediente::create([
            'id_receta' => $receta1->id,
            'Descripcion' => 'Carne molida de res',
        ]);

        Ingrediente::create([
            'id_receta' => $receta1->id,
            'Descripcion' => 'Spaghetti',
        ]);

        Ingrediente::create([
            'id_receta' => $receta1->id,
            'Descripcion' => 'Tomates',
        ]);

        Ingrediente::create([
            'id_receta' => $receta1->id,
            'Descripcion' => 'Cebolla',
        ]);

        Ingrediente::create([
            'id_receta' => $receta1->id,
            'Descripcion' => 'Ajo',
        ]);

        Ingrediente::create([
            'id_receta' => $receta1->id,
            'Descripcion' => 'Zanahoria',
        ]);

        Ingrediente::create([
            'id_receta' => $receta1->id,
            'Descripcion' => 'Aceite de oliva',
        ]);

        Ingrediente::create([
            'id_receta' => $receta1->id,
            'Descripcion' => 'Sal y pimienta',
        ]);

        Ingrediente::create([
            'id_receta' => $receta1->id,
            'Descripcion' => 'Albahaca fresca',
        ]);

        Ingrediente::create([
            'id_receta' => $receta1->id,
            'Descripcion' => 'Queso parmesano rallado',
        ]);

        Paso::create([
            'id_receta' => $receta1->id,
            'numero' => 1,
            'descripcion' => 'Picar finamente la cebolla, el ajo y la zanahoria.',
        ]);

        Paso::create([
            'id_receta' => $receta1->id,
            'numero' => 2,
            'descripcion' => 'Calentar una sartén con aceite de oliva y saltear la cebolla, el ajo y la zanahoria hasta que estén dorados.',
        ]);

        Paso::create([
            'id_receta' => $receta1->id,
            'numero' => 3,
            'descripcion' => 'Agregar la carne molida y cocinar hasta que esté bien dorada.',
        ]);

        Paso::create([
            'id_receta' => $receta1->id,
            'numero' => 4,
            'descripcion' => 'Agregar los tomates picados y cocinar a fuego lento durante 30 minutos.',
        ]);

        Paso::create([
            'id_receta' => $receta1->id,
            'numero' => 5,
            'descripcion' => 'Cocinar los spaghetti en agua hirviendo con sal hasta que estén al dente.',
        ]);

        Paso::create([
            'id_receta' => $receta1->id,
            'numero' => 6,
            'descripcion' => 'Servir los spaghetti con la salsa bolognesa y espolvorear con queso parmesano rallado y hojas de albahaca fresca.',
        ]);

        $receta2 = Receta::create([
            'nombre' => 'Pollo al Curry con Arroz Basmati',
            'descripcion' => 'Pollo cocinado lentamente en una deliciosa salsa de curry con especias, servido con arroz basmati fragante.',
            'id_chef' => 2,
            'img_url'=>'https://th.bing.com/th/id/OIP.CIeyOCfUqlROgQR6Fi7PUwHaEK?rs=1&pid=ImgDetMain',
        ]);
        
        Ingrediente::create([
            'id_receta' => $receta2->id,
            'Descripcion' => 'Pechugas de pollo',
        ]);
        
        Ingrediente::create([
            'id_receta' => $receta2->id,
            'Descripcion' => 'Cebolla',
        ]);
        
        Ingrediente::create([
            'id_receta' => $receta2->id,
            'Descripcion' => 'Ajo',
        ]);
        
        Ingrediente::create([
            'id_receta' => $receta2->id,
            'Descripcion' => 'Jengibre fresco',
        ]);
        
        Ingrediente::create([
            'id_receta' => $receta2->id,
            'Descripcion' => 'Tomates',
        ]);
        
        Ingrediente::create([
            'id_receta' => $receta2->id,
            'Descripcion' => 'Leche de coco',
        ]);
        
        Ingrediente::create([
            'id_receta' => $receta2->id,
            'Descripcion' => 'Curry en polvo',
        ]);
        
        Ingrediente::create([
            'id_receta' => $receta2->id,
            'Descripcion' => 'Cilantro fresco',
        ]);
        
        Paso::create([
            'id_receta' => $receta2->id,
            'numero' => 1,
            'descripcion' => 'Cortar las pechugas de pollo en trozos y sazonar con sal y pimienta.',
        ]);
        
        Paso::create([
            'id_receta' => $receta2->id,
            'numero' => 2,
            'descripcion' => 'Calentar una sartén con aceite de oliva y dorar el pollo por todos los lados. Reservar.',
        ]);
        
        Paso::create([
            'id_receta' => $receta2->id,
            'numero' => 3,
            'descripcion' => 'En la misma sartén, agregar más aceite si es necesario y saltear la cebolla, el ajo y el jengibre hasta que estén fragantes.',
        ]);
        
        Paso::create([
            'id_receta' => $receta2->id,
            'numero' => 4,
            'descripcion' => 'Agregar los tomates picados y cocinar hasta que se ablanden.',
        ]);
        
        Paso::create([
            'id_receta' => $receta2->id,
            'numero' => 5,
            'descripcion' => 'Regresar el pollo a la sartén y agregar la leche de coco y el curry en polvo. Cocinar a fuego lento hasta que el pollo esté cocido y la salsa se haya espesado.',
        ]);
        
        Paso::create([
            'id_receta' => $receta2->id,
            'numero' => 6,
            'descripcion' => 'Servir el pollo al curry caliente sobre arroz basmati cocido y espolvorear con cilantro fresco picado.',
        ]);

        // Receta 3: Tacos de Camarones al Chipotle
        $receta3 = Receta::create([
            'nombre' => 'Tacos de Camarones al Chipotle',
            'descripcion' => 'Tacos mexicanos rellenos de camarones salteados en una salsa picante de chipotle, acompañados de guacamole y cilantro fresco.',
            'id_chef' => 2,
            'img_url'=>'https://www.diariodepalenque.com.mx/wp-content/uploads/2016/09/tacos-camaron-al-chipotle.jpg',
        ]);

        Ingrediente::create([
            'id_receta' => $receta3->id,
            'Descripcion' => 'Camarones',
        ]);

        Ingrediente::create([
            'id_receta' => $receta3->id,
            'Descripcion' => 'Chipotles en adobo',
        ]);

        Ingrediente::create([
            'id_receta' => $receta3->id,
            'Descripcion' => 'Tortillas de maíz',
        ]);

        Ingrediente::create([
            'id_receta' => $receta3->id,
            'Descripcion' => 'Cebolla morada',
        ]);

        Ingrediente::create([
            'id_receta' => $receta3->id,
            'Descripcion' => 'Aguacate',
        ]);

        Ingrediente::create([
            'id_receta' => $receta3->id,
            'Descripcion' => 'Limón',
        ]);

        Ingrediente::create([
            'id_receta' => $receta3->id,
            'Descripcion' => 'Cilantro fresco',
        ]);

        Paso::create([
            'id_receta' => $receta3->id,
            'numero' => 1,
            'descripcion' => 'Pelar y limpiar los camarones, retirando las cabezas y las cáscaras.',
        ]);

        Paso::create([
            'id_receta' => $receta3->id,
            'numero' => 2,
            'descripcion' => 'En una sartén caliente, saltear los camarones con chipotles en adobo picados hasta que estén cocidos y ligeramente dorados.',
        ]);

        Paso::create([
            'id_receta' => $receta3->id,
            'numero' => 3,
            'descripcion' => 'Calentar las tortillas de maíz en una sartén hasta que estén ligeramente doradas y flexibles.',
        ]);

        Paso::create([
            'id_receta' => $receta3->id,
            'numero' => 4,
            'descripcion' => 'Preparar el guacamole machacando aguacate con cebolla morada picada, jugo de limón y sal al gusto.',
        ]);

        Paso::create([
            'id_receta' => $receta3->id,
            'numero' => 5,
            'descripcion' => 'Rellenar las tortillas con los camarones al chipotle y servir con guacamole y cilantro fresco encima.',
        ]);
    }
}
