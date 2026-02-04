<?php
$catalogo = [

    "Transmisión" => [
        ["codigo" => "P001137", "nombre" => "Ajustador Cadena Tracción Gen 125"],
        ["codigo" => "P001133", "nombre" => "Ajustador de Cadena CG-125"],
        ["codigo" => "P001100", "nombre" => "Cadena Tracción 428H-136L"],
        ["codigo" => "P001104", "nombre" => "Cadena Tracción 520H-120L"],
        ["codigo" => "P020043", "nombre" => "Rear Sprocket AKT 150 520-39T"]
    ],

    "Suspensión" => [
        ["codigo" => "P002696", "nombre" => "Amortiguador Trasero Boxer BM100"],
        ["codigo" => "P002723", "nombre" => "Amortiguador Trasero Negro XL-125R"],
        ["codigo" => "P002764", "nombre" => "Amortiguador Trasero YBR125 (Set)"],
        ["codigo" => "P007343", "nombre" => "Barra de Suspensión CG / Serpento"]
    ],

    "Motor" => [
        ["codigo" => "P003597", "nombre" => "Anillos CG-125 STD 56.5MM"],
        ["codigo" => "P005248", "nombre" => "Árbol de Leva CG-125"],
        ["codigo" => "P011016", "nombre" => "Carburador Pulsar 180"],
        ["codigo" => "S000598", "nombre" => "Cilindro Completo CY-200"]
    ],

    "Eléctrico" => [
        ["codigo" => "P001648", "nombre" => "Batería YTX5L"],
        ["codigo" => "P005510", "nombre" => "Bobina Inferior GXT 200"],
        ["codigo" => "P001589", "nombre" => "CDI CG 200"],
        ["codigo" => "P010720", "nombre" => "Motor de Arranque XR 150L"]
    ],

    "Frenos" => [
        ["codigo" => "P001823", "nombre" => "Pastilla de Freno 125/CA-250"],
        ["codigo" => "P001840", "nombre" => "Pastillas Pulsar NS 200 Delanteras"],
        ["codigo" => "P014830", "nombre" => "Bomba de Freno Trasero Pulsar 200"]
    ],

    "Accesorios" => [
        ["codigo" => "P001500", "nombre" => "Espejo Retrovisor Universal"],
        ["codigo" => "P011972", "nombre" => "Careta con Foco Pulsar 180 Azul"],
        ["codigo" => "P002460", "nombre" => "Malla para Casco"]
    ]
];
?>

<link rel="stylesheet" href="/assets/css/dark.css">

<div class="container">
    <h2>Catálogo de Repuestos</h2>

    <?php foreach ($catalogo as $categoria => $items): ?>
        <h3 style="margin-top:20px;"><?= $categoria ?></h3>

        <?php foreach ($items as $item): ?>
            <div class="card" style="margin-bottom:8px;">
                <b><?= $item["nombre"] ?></b><br>
                <span class="muted">Código:</span> <?= $item["codigo"] ?>
            </div>
        <?php endforeach; ?>

    <?php endforeach; ?>
</div>
