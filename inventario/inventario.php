<?php
$catalogo = [
    "Transmisión" => [
        ["codigo" => "P001137", "nombre" => "Ajustador Cadena Tracción Gen 125", "precio" => 24.50, "stock" => 15],
        ["codigo" => "P001133", "nombre" => "Ajustador de Cadena CG-125", "precio" => 18.75, "stock" => 22],
        ["codigo" => "P001100", "nombre" => "Cadena Tracción 428H-136L", "precio" => 32.90, "stock" => 8],
        ["codigo" => "P001104", "nombre" => "Cadena Tracción 520H-120L", "precio" => 45.25, "stock" => 12],
        ["codigo" => "P020043", "nombre" => "Rear Sprocket AKT 150 520-39T", "precio" => 28.40, "stock" => 5]
    ],
    "Suspensión" => [
        ["codigo" => "P002696", "nombre" => "Amortiguador Trasero Boxer BM100", "precio" => 42.80, "stock" => 7],
        ["codigo" => "P002723", "nombre" => "Amortiguador Trasero Negro XL-125R", "precio" => 38.90, "stock" => 14],
        ["codigo" => "P002764", "nombre" => "Amortiguador Trasero YBR125 (Set)", "precio" => 67.50, "stock" => 3],
        ["codigo" => "P007343", "nombre" => "Barra de Suspensión CG / Serpento", "precio" => 22.30, "stock" => 19]
    ],
    "Motor" => [
        ["codigo" => "P003597", "nombre" => "Anillos CG-125 STD 56.5MM", "precio" => 12.40, "stock" => 25],
        ["codigo" => "P005248", "nombre" => "Árbol de Leva CG-125", "precio" => 84.60, "stock" => 6],
        ["codigo" => "P011016", "nombre" => "Carburador Pulsar 180", "precio" => 112.80, "stock" => 4],
        ["codigo" => "S000598", "nombre" => "Cilindro Completo CY-200", "precio" => 156.90, "stock" => 2]
    ],
    "Eléctrico" => [
        ["codigo" => "P001648", "nombre" => "Batería YTX5L", "precio" => 68.50, "stock" => 9],
        ["codigo" => "P005510", "nombre" => "Bobina Inferior GXT 200", "precio" => 34.20, "stock" => 11],
        ["codigo" => "P001589", "nombre" => "CDI CG 200", "precio" => 41.80, "stock" => 13],
        ["codigo" => "P010720", "nombre" => "Motor de Arranque XR 150L", "precio" => 97.30, "stock" => 5]
    ],
    "Frenos" => [
        ["codigo" => "P001823", "nombre" => "Pastilla de Freno 125/CA-250", "precio" => 14.90, "stock" => 28],
        ["codigo" => "P001840", "nombre" => "Pastillas Pulsar NS 200 Delanteras", "precio" => 19.75, "stock" => 16],
        ["codigo" => "P014830", "nombre" => "Bomba de Freno Trasero Pulsar 200", "precio" => 52.40, "stock" => 7]
    ],
    "Accesorios" => [
        ["codigo" => "P001500", "nombre" => "Espejo Retrovisor Universal", "precio" => 16.50, "stock" => 32],
        ["codigo" => "P011972", "nombre" => "Careta con Foco Pulsar 180 Azul", "precio" => 89.90, "stock" => 8],
        ["codigo" => "P002460", "nombre" => "Malla para Casco", "precio" => 8.25, "stock" => 45]
    ]
];

$items = [];
foreach ($catalogo as $categoria => $productos) {
    foreach ($productos as $producto) {
        $producto['categoria'] = $categoria;
        $items[] = $producto;
    }
}

usort($items, function ($a, $b) {
    return $a['stock'] <=> $b['stock'];
});
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <link rel="stylesheet" href="../assets/css/dark.css">
    <style>
        table { width:100%; border-collapse: collapse; margin-top: 12px; }
        th, td { text-align:left; padding:10px; border-bottom: 1px solid rgba(255,255,255,0.08); }
        th { color:#9aa3ad; font-weight:600; }
        .stock-ok { color:#4aa3a3; font-weight:700; }
        .stock-low { color:#f0b35c; font-weight:700; }
        .stock-critical { color:#e06c75; font-weight:700; }
    </style>
</head>
<body>
<div class="container">
    <h2>Inventario de Repuestos</h2>
    <p class="muted">Consulta rápida de existencias por producto.</p>
    <p><a href="catalogo.php">Volver al catalogo</a></p>

    <table>
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Producto</th>
                <th>Categoria</th>
                <th>Stock</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <?php
                    $estado = 'Disponible';
                    $class = 'stock-ok';
                    if ($item['stock'] <= 5) {
                        $estado = 'Critico';
                        $class = 'stock-critical';
                    } elseif ($item['stock'] <= 10) {
                        $estado = 'Bajo';
                        $class = 'stock-low';
                    }
                ?>
                <tr>
                    <td><?= htmlspecialchars($item['codigo']) ?></td>
                    <td><?= htmlspecialchars($item['nombre']) ?></td>
                    <td><?= htmlspecialchars($item['categoria']) ?></td>
                    <td class="<?= $class ?>"><?= (int)$item['stock'] ?></td>
                    <td class="<?= $class ?>"><?= $estado ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
