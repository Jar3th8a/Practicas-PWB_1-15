<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriaProductoSeeder extends Seeder
{
    public function run(): void
    {
        $categoriasBase = [
            'Electronica',
            'Ropa',
            'Hogar',
            'Deportes',
        ];

        $categorias = collect();

        foreach ($categoriasBase as $nombre) {
            $categorias->push(Categoria::create([
                'nombre' => $nombre,
                'slug' => Str::slug($nombre),
                'descripcion' => 'Categoria de prueba para la practica 6.',
            ]));
        }

        $productos = [
            ['Auriculares Bluetooth', 'Cancelacion de ruido y bateria de larga duracion', 1599.00, 24],
            ['Laptop Gamer', 'Ryzen 7, 16GB RAM y 1TB SSD', 25999.00, 8],
            ['Smartwatch', 'Pantalla AMOLED y monitoreo de salud', 2499.00, 18],
            ['Tablet Android', 'Pantalla de 11 pulgadas y 128GB', 6999.00, 14],
            ['Sudadera Unisex', 'Algodon premium talla M', 799.00, 30],
            ['Playera Basica', 'Corte clasico en varias tallas', 249.00, 60],
            ['Pantalon Jeans', 'Mezclilla elastica y resistente', 899.00, 26],
            ['Tenis Running', 'Suela ligera para entrenamiento', 1399.00, 20],
            ['Sofa Modular', 'Tres plazas con tapizado gris', 8999.00, 4],
            ['Lampara LED', 'Luz regulable con puerto USB', 599.00, 35],
            ['Juego de Sartenes', 'Set antiadherente de 5 piezas', 1299.00, 22],
            ['Organizador de Cocina', 'Accesorios para despensa y gabinete', 349.00, 40],
            ['Balon de Futbol', 'Talla oficial para entrenamiento', 499.00, 50],
            ['Mancuernas Ajustables', 'Par de 10 a 20 kg', 2999.00, 12],
            ['Cuerda para Saltar', 'Cable de acero con mangos ergonomicos', 199.00, 45],
            ['Termo Deportivo', 'Acero inoxidable 1 litro', 289.00, 38],
            ['Teclado Mecanico', 'Switches rojos y retroiluminacion RGB', 1799.00, 17],
            ['Monitor 27 pulgadas', 'Resolucion QHD 165Hz', 6899.00, 11],
            ['Mouse Inalambrico', 'Sensor optico y bateria recargable', 649.00, 29],
            ['Cama Individual', 'Estructura de madera reforzada', 5499.00, 6],
        ];

        foreach ($productos as $index => $data) {
            [$nombre, $descripcion, $precio, $stock] = $data;

            Producto::create([
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'precio' => $precio,
                'stock' => $stock,
                'categoria_id' => $categorias[$index % $categorias->count()]->id,
            ]);
        }
    }
}
