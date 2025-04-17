<?php
    
    session_start();
    if (!isset($_SESSION['user'])) {
        header("Location: ../index.php");
        exit;
    }

    $tiempo_vida = 1800; // 30 minutos en segundos
    session_set_cookie_params($tiempo_vida);
    include "includes/scripts.php";
    include "includes/header.php";
    include "../conexion.php"; 

/* numero de compras de computadora */
$sql = mysqli_query($conexion, "SELECT COUNT(id_compra) FROM compras WHERE tipo='COMPUTADORA' and estado = 'aprobado';");
$result_f = mysqli_fetch_array($sql);
$PC = $result_f['COUNT(id_compra)']; 
/* numero de compras de ps4/ps5 */
$sql2 = mysqli_query($conexion, "SELECT COUNT(id_compra) FROM compras WHERE tipo='PS4/PS5' and estado = 'aprobado';");
$result_f2 = mysqli_fetch_array($sql2);
$PLAY = $result_f2['COUNT(id_compra)']; 
/* compras pendientes */
$sql3 = mysqli_query($conexion, "SELECT COUNT(id_compra) FROM compras WHERE estado = 'en espera';");
$result_f3 = mysqli_fetch_array($sql3);
$PENDIENTES = $result_f3['COUNT(id_compra)']; 
/* compras aprobadas */
$sql4 = mysqli_query($conexion, "SELECT COUNT(id_compra) FROM compras WHERE estado = 'aprobado';");
$result_f4 = mysqli_fetch_array($sql4);
$total_compras = $result_f4['COUNT(id_compra)']; 

/* Nuevos saldos individuales */
$saldo_jesus_pc = $PC * 17;      // 17 Bs por venta de PC
$saldo_jose_pc = $PC * 17;       // 17 Bs por venta de PC
$saldo_alejandro_pc = $PC * 16;  // 16 Bs por venta de PC

$saldo_jesus_play = $PLAY * 15;     // 15 Bs por venta de PS4/PS5
$saldo_jose_play = $PLAY * 15;      // 15 Bs por venta de PS4/PS5
$saldo_alejandro_play = $PLAY * 10; // 10 Bs por venta de PS4/PS5

/* Totales por persona */
$saldo_jesus = $saldo_jesus_pc + $saldo_jesus_play;
$saldo_jose = $saldo_jose_pc + $saldo_jose_play;
$saldo_alejandro = $saldo_alejandro_pc + $saldo_alejandro_play;

/* Saldo total general */
$saldo_total = $saldo_jesus + $saldo_jose + $saldo_alejandro;

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        
        <title>PES-BOLIVIA Dashboard</title>
        
        <style>
 .modal-content {
            border-radius: 1rem;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            background: linear-gradient(135deg, #ffffff, #f3f4f6);
        }
        .modal-header {
            background: #1e40af;
            color: white;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }
        .modal-title {
            font-weight: 700;
        }
        .carousel-item img {
            border-radius: 0.5rem;
            max-height: 400px;
            object-fit: cover;
            margin: auto;
        }
        .description-list {
            list-style-type: none;
            padding: 0;
        }
        .description-list li {
            padding: 0.5rem 0;
            display: flex;
            align-items: center;
        }
        .description-list li::before {
            content: '✔';
            color: #1e40af;
            margin-right: 0.5rem;
            font-weight: bold;
        }
        .btn-close {
            filter: invert(1);
        }
        .thumbnail-container {
            display: flex;
            overflow-x: auto;
            gap: 0.5rem;
            padding: 0.5rem 0;
            margin-top: 1rem;
        }
        .thumbnail {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: transform 0.2s, border 0.2s;
            border: 2px solid transparent;
        }
        .thumbnail:hover {
            transform: scale(1.1);
            border: 2px solid #1e40af;
        }
        .thumbnail.active {
            border: 2px solid #1e40af;
        }
        .conCompras{
            color: #3ba165;
            background: #d9ffd7;
            padding: 12px;
            border-radius: 14px;
            margin: 8px;
            border-bottom: 2px solid #3ba165;
        }
        .sinCompras{
            color: #3d3d3d;
            background: #e5e5e5;
            padding: 12px;
            border-radius: 14px;
            margin: 8px;
            border-bottom: 2px solid #797979;
        }
        .tarjeta1{
            color: #3a874e;
            background: #e6ffe6;
            padding: 12px;
            border-radius: 14px;
            margin: 8px;
            border-bottom: 2px solid #474747;
        }
        .tarjeta2{
            color: #060d16;
            background: #d2e1fb;
            padding: 12px;
            border-radius: 14px;
            margin: 8px;
            border-bottom: 2px solid #797979;
        }
        .tarjeta3{
            background: #e6ffe6;
            padding: 10px;
            border-radius: 10px;
            border: 1px solid gray;
        }
        .tarjeta4{
            background: #e7f1ff;
            padding: 10px;
            border-radius: 10px;
            border: 1px solid gray;
        }
        </style>
    </head>
    
    <body class="sb-nav-fixed">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 py-4">
                    <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert" style="background-color: #b2ffdb;border:none;color:#575757"> 
                        <?php echo $_SESSION['nombre']  ?>  <strong> Bienvenido a PES BOLIVIA  !  
                        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button> 
                    </div>

                    <?php if ($_SESSION['rol'] == 1) { ?> 
                    <div class="row g-4">
                        <!-- Columna Izquierda: Información (6) -->
                        <div class="col-lg-6" style="padding: 15px; background: #fbfbfb;border: 1px solid #e5e5e5;">
                            <div class="sidebar">
                                <div class="section-title"><i class="bi bi-bar-chart-line me-1"></i> Estadísticas</div>
                                
                                <div class="row g-3">
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="stat-box  <?php echo $PENDIENTES > 0 ? 'conCompras' : 'sinCompras'; ?>">
                                            <h6>Compras Pendientes</h6>
                                            <span><?php echo $PENDIENTES;?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="stat-box approved-box tarjeta1">
                                            <h6>Compras Aprobadas</h6>
                                            <span class="text-success "><?php echo $total_compras;?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="stat-box total-box tarjeta2">
                                            <h6>Total Acumulado</h6>
                                            <span class="text-dark"><?php echo number_format($saldo_total,2,'.',',');?> Bs</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="stat-card pc-card tarjeta4">
                                        <div class="card-header">
                                            <i class="bi bi-laptop me-2"></i> Ventas PC
                                        </div>
                                        <div class="card-body">
                                            <div class="stat-item">
                                                <i class="bi bi-cart-check me-2 pc-color"></i>
                                                <span>Compras:</span> <strong class="pc-color"><?php echo $PC;?></strong>
                                            </div>
                                            <div class="stat-item">
                                                <i class="bi bi-currency-exchange me-2 pc-color"></i>
                                                <span>Ingresos:</span> <strong class="pc-color"><?php echo number_format($PC * 50,2,'.',',');?> Bs</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="stat-card play-card tarjeta3">
                                        <div class="card-header">
                                            <i class="bi bi-joystick me-2"></i> Ventas PS4/PS5
                                        </div>
                                        <div class="card-body">
                                            <div class="stat-item">
                                                <i class="bi bi-cart-check me-2 play-color"></i>
                                                <span>Compras:</span> <strong class="play-color"><?php echo $PLAY;?></strong>
                                            </div>
                                            <div class="stat-item">
                                                <i class="bi bi-currency-exchange me-2 play-color"></i>
                                                <span>Ingresos:</span> <strong class="play-color"><?php echo number_format($PLAY * 40,2,'.',',');?> Bs</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            

                    </div>
                    <hr>
                            <div class="sidebar">
                                <?php if ($_SESSION['user'] == 'admin' or $_SESSION['user'] == 'jhap10' or $_SESSION['user'] == 'jesus.velasco') { ?>
                                <div class="section-title ">
                                    <i class="bi bi-people me-1"></i> Saldos Individuales

                                    <?php if ($_SESSION['user'] == 'admin') { ?>
                                <button type="button" class="btn btn-sm btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#registrarPago">
                                        <i class="bi bi-plus-circle"></i> Registrar Pago
                                    </button>
                                <?php } ?>
                                    
                                    
                                </div>
                                <table style="width: 100%; border-collapse: collapse; font-size: 0.85rem; background: #ffffff; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-radius: 8px; overflow: hidden;">
    <thead style="background: linear-gradient(135deg, #e9ecef, #dee2e6); color: #495057; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
        <tr>
            <th style="padding: 10px; text-align: left;"><i class="bi bi-person me-1"></i> Nombre</th>
            <th style="padding: 10px; text-align: center;">PC</th>
            <th style="padding: 10px; text-align: center;">PS4/PS5</th>
            <th style="padding: 10px; text-align: center;">Total</th>
            <th style="padding: 10px; text-align: center;">Pagado</th>
            <th style="padding: 10px; text-align: center;">Deuda</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $editores = [
            'Jesús' => [$saldo_jesus_pc, $saldo_jesus_play, $saldo_jesus],
            'José' => [$saldo_jose_pc, $saldo_jose_play, $saldo_jose],
            'Alejandro' => [$saldo_alejandro_pc, $saldo_alejandro_play, $saldo_alejandro]
        ];

        foreach ($editores as $nombre => $saldos) {
            $sql_pago = mysqli_query($conexion, "SELECT SUM(monto_pagado) as total_pagado FROM pagos WHERE nombre='$nombre'");
            $result_pago = mysqli_fetch_array($sql_pago);
            $pagado = $result_pago['total_pagado'] ?? 0;
            $deuda = $saldos[2] - $pagado;
        ?>
        <tr style="border-bottom: 1px solid #e9ecef; transition: background 0.2s; ">
            <td data-label="Nombre" style="padding: 8px; text-align: left; font-weight: 600;"><?php echo $nombre;?></td>
            <td data-label="PC" style="padding: 8px; text-align: center;">
                <span class="pc-color" style="font-weight: 600;"><?php echo number_format($saldos[0],2,'.',',');?> Bs</span>
                <div style="font-size: 0.75rem; color: #6c757d;"><?php echo $PC;?> ventas</div>
            </td>
            <td data-label="PS4/PS5" style="padding: 8px; text-align: center;">
                <span class="play-color" style="font-weight: 600;"><?php echo number_format($saldos[1],2,'.',',');?> Bs</span>
                <div style="font-size: 0.75rem; color: #6c757d;"><?php echo $PLAY;?> ventas</div>
            </td>
            <td data-label="Total" style="padding: 8px; text-align: center;"><strong style="color: #212529;"><?php echo number_format($saldos[2],2,'.',',');?> Bs</strong></td>
            <td data-label="Pagado" style="padding: 8px; text-align: center;"><span class="text-success" style="font-weight: 600;"><i class="bi bi-check-circle me-1"></i><?php echo number_format($pagado,2,'.',',');?> Bs</span></td>
            <td data-label="Deuda" style="padding: 8px; text-align: center;">
                <span class="<?php echo $deuda > 0 ? 'text-danger' : 'text-success';?>" style="font-weight: 600;">
                    <?php echo $deuda > 0 ? '<i class="bi bi-exclamation-triangle me-1"></i>' : '<i class="bi bi-check-circle me-1"></i>';?>
                    <?php echo number_format($deuda,2,'.',',');?> Bs
                </span>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    <style>
        @media (max-width: 768px) {
            table {
                display: block;
                box-shadow: none;
                border-radius: 0;
            }
            thead {
                display: none;
            }
            tbody, tr {
                display: block;
                width: 100%;
            }
            tr {
                background: #ffffff;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                margin-bottom: 15px;
                padding: 10px;
                border-bottom: none;
            }
            td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 6px 10px;
                text-align: left !important;
                border-bottom: 1px solid #e9ecef;
            }
            td:last-child {
                border-bottom: none;
            }
            td:before {
                content: attr(data-label);
                font-weight: 600;
                color: #495057;
                margin-right: 10px;
                flex-shrink: 0;
            }
            td:first-child {
                background: linear-gradient(135deg, #f8f9fa, #e9ecef);
                font-size: 1rem;
                padding: 10px;
                border-radius: 8px 8px 0 0;
                justify-content: center;
                border-bottom: none;
            }
            td:first-child:before {
                content: none;
            }
            
            
        }
    </style>
</table>
                                <?php } else { 
                                    $name = $_SESSION['nombre'];
                                    $sqlpago = mysqli_query($conexion, "SELECT SUM(monto_pagado) as total_pagado FROM pagos WHERE nombre='$name'");
                                    $result_pago = mysqli_fetch_array($sqlpago);
                                    $pago = $result_pago['total_pagado'] ?? 0;
                                    $deuda = ($name == 'Jesús' ? $saldo_jesus : ($name == 'Jose Avendaño' ? $saldo_jose : $saldo_alejandro)) - $pago;
                                ?>
                                <div class="section-title mt-4"><i class="bi bi-wallet me-1"></i> Mi Saldo</div>
                                <div class="stat-box">
                                    <h6>Cancelado</h6>
                                    <span class="text-success"><?php echo number_format($pago,2,'.',',');?> Bs</span>
                                </div>
                                <div class="stat-box">
                                    <h6>Deuda</h6>
                                    <span class="text-danger"><?php echo number_format($deuda,2,'.',',');?> Bs</span>
                                </div>
                                <?php } ?>
                            </div>
                        </div>

                        <!-- Columna Derecha: Gráfico (6) -->
                        <div class="col-lg-6" style="padding: 15px; background: #fbfbfb;border: 1px solid #e5e5e5;">
                            <div class="content-card">
                                <div class="section-title"><i class="bi bi-graph-up me-1"></i> Estadísticas de Ventas</div>
                                <canvas id="grafico" height="200"></canvas>
                            </div>
                        </div>
                    </div>

                    <?php if ($_SESSION['user'] == 'admin') { ?>
                        
                    <div class="modal fade" id="registrarPago" tabindex="-1" aria-labelledby="registrarPagoLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="registrarPagoLabel">Registrar Pago</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="procesar_pago.php" method="POST">
                                        <div class="mb-3">
                                            <label for="editor" class="form-label">Editor</label>
                                            <select class="form-select" id="editor" name="editor" required>
                                                <option value="Jesús">Jesús</option>
                                                <option value="José">José</option>
                                                <option value="Alejandro">Alejandro</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="monto" class="form-label">Monto Pagado (Bs)</label>
                                            <input type="number" step="0.01" class="form-control" id="monto" name="monto" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="metodo" class="form-label">Método de Pago</label>
                                            <input type="text" class="form-control" id="metodo" name="metodo" placeholder="Ej. Efectivo, Transferencia">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nota" class="form-label">Nota (Opcional)</label>
                                            <textarea class="form-control" id="nota" name="nota" rows="2"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">Registrar Pago</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php } ?>

                    <?php if ($_SESSION['rol'] != 1) { ?> 
<div class="row g-4">
    <div class="col-12">
        <div class="content-card" style="background: #ffffff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); padding: 20px;">
            <div class="section-title" style="color: #212529; font-weight: 600; margin-bottom: 20px; font-size: 1.25rem;">
                <i class="bi bi-shop me-1"></i> Tienda
            </div>
            <div class="row g-3">
                <!-- Tarjeta PC -->
                <div class="col-md-3 col-sm-3 col-12">
                    <div class="shop-card" style="background: linear-gradient(135deg, #e7f1ff, #ffffff); border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.2s;">
                        <div class="card-img" style="height: 450px; overflow: hidden;">
                            <img src="../assets/images/PC1.png" alt="AIRPATCH 2025 PC" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body" style="padding: 15px; text-align: center;">
                            <h6 style="font-size: 1.1rem; font-weight: 600; color: #007bff; margin-bottom: 10px;">
                                <i class="bi bi-laptop me-1"></i> AIRPATCH 2025 PC
                            </h6>
                            <p style="margin-bottom: 10px;">
                                <strong class="pc-color" style="font-size: 1.2rem;">50 Bs</strong>
                                <small class="text-muted" style="font-size: 0.85rem;">/Temporada 2025</small>
                            </p>
                            <ul style="list-style: none; padding: 0; margin-bottom: 15px; font-size: 0.9rem; color: #495057;">
                                <li>Temporada 2025 liga boliviana</li>
                                <li>Copa Simón Bolívar</li>
                                <li>Libertadores 2025</li>
                            </ul>
                            <div style="display: flex; gap: 10px; justify-content: center;">
                                <a class="btn btn-sm btn-outline-danger" href="compras/" style="width: 120px; font-size: 0.9rem;">
                                    <i class="bi bi-bag me-1"></i> Comprar
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#pc" style="width: 120px; font-size: 0.9rem;">
                                    <i class="bi bi-eye me-1"></i> Novedades
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tarjeta PS4/PS5 -->
                <div class="col-md-3 col-sm-3 col-12">
                    <div class="shop-card" style="background: linear-gradient(135deg, #e6ffe6, #ffffff); border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); overflow: hidden; transition: transform 0.2s;">
                        <div class="card-img" style="height: 450px; overflow: hidden;">
                            <img src="../assets/images/PS4.png" alt="OPTION FILE PS4/PS5" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div class="card-body" style="padding: 15px; text-align: center;">
                            <h6 style="font-size: 1.1rem; font-weight: 600; color: #28a745; margin-bottom: 10px;">
                                <i class="bi bi-joystick me-1"></i> OPTION FILE PS4/PS5
                            </h6>
                            <p style="margin-bottom: 10px;">
                                <strong class="play-color" style="font-size: 1.2rem;">40 Bs</strong>
                                <small class="text-muted" style="font-size: 0.85rem;">/Temporada 2025</small>
                            </p>
                            <ul style="list-style: none; padding: 0; margin-bottom: 15px; font-size: 0.9rem; color: #495057;">
                                <li>Temporada 2025 liga boliviana</li>
                                <li>Plantillas 2025</li>
                                <li>Libertadores 2025</li>
                            </ul>
                            <div style="display: flex; gap: 10px; justify-content: center;">
                                <a class="btn btn-sm btn-outline-danger" href="compras/" style="width: 120px; font-size: 0.9rem;">
                                    <i class="bi bi-bag me-1"></i> Comprar
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#ps4" style="width: 120px; font-size: 0.9rem;">
                                    <i class="bi bi-eye me-1"></i> Novedades
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

                    <!-- Modales -->
<!-- Modal PC -->
<div class="modal fade" id="pc" tabindex="-1" aria-labelledby="pcLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="pcLabel">Airpatch 2025 PC</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Carousel for PC -->
                            <div id="carouselPC" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="img/pc/1.png" class="d-block w-100" alt="PC Image 1">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="img/pc/2.png" class="d-block w-100" alt="PC Image 2">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="img/pc/3.png" class="d-block w-100" alt="PC Image 3">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="img/pc/4.png" class="d-block w-100" alt="PC Image 4">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="img/pc/5.png" class="d-block w-100" alt="PC Image 5">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="img/pc/6.png" class="d-block w-100" alt="PC Image 6">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="img/pc/7.png" class="d-block w-100" alt="PC Image 7">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="img/pc/8.png" class="d-block w-100" alt="PC Image 8">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="img/pc/9.png" class="d-block w-100" alt="PC Image 9">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="img/pc/10.png" class="d-block w-100" alt="PC Image 10">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselPC" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselPC" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <!-- Thumbnails for PC -->
                            <div class="thumbnail-container">
                                <img src="img/pc/1.png" class="thumbnail active" data-bs-target="#carouselPC" data-bs-slide-to="0" alt="Thumbnail 1">
                                <img src="img/pc/2.png" class="thumbnail" data-bs-target="#carouselPC" data-bs-slide-to="1" alt="Thumbnail 2">
                                <img src="img/pc/3.png" class="thumbnail" data-bs-target="#carouselPC" data-bs-slide-to="2" alt="Thumbnail 3">
                                <img src="img/pc/4.png" class="thumbnail" data-bs-target="#carouselPC" data-bs-slide-to="3" alt="Thumbnail 4">
                                <img src="img/pc/5.png" class="thumbnail" data-bs-target="#carouselPC" data-bs-slide-to="4" alt="Thumbnail 5">
                                <img src="img/pc/6.png" class="thumbnail" data-bs-target="#carouselPC" data-bs-slide-to="5" alt="Thumbnail 6">
                                <img src="img/pc/7.png" class="thumbnail" data-bs-target="#carouselPC" data-bs-slide-to="6" alt="Thumbnail 7">
                                <img src="img/pc/8.png" class="thumbnail" data-bs-target="#carouselPC" data-bs-slide-to="7" alt="Thumbnail 8">
                                <img src="img/pc/9.png" class="thumbnail" data-bs-target="#carouselPC" data-bs-slide-to="8" alt="Thumbnail 9">
                                <img src="img/pc/10.png" class="thumbnail" data-bs-target="#carouselPC" data-bs-slide-to="9" alt="Thumbnail 10">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3 class="font-bold text-lg mb-4">Características:</h3>
                            <ul class="description-list">
                                <li>Nuevo menú de inicio</li>
                                <li>Menú de Primera División</li>
                                <li>Plantillas Actualizadas a Abril 2025</li>
                                <li>Todos los kits de equipos bolivianos</li>
                                <li>Scoreboard Torneo Cotas, Primera División y Simón Bolívar</li>
                                <li>Balón Penalty 2025</li>
                                <li>Estadios Bolivianos</li>
                                <li>Cánticos de equipos bolivianos</li>
                                <li>Más de 300 faces en jugadores de equipos bolivianos</li>
                                <li>Más de 600 minifaces de solo equipos bolivianos</li>
                                <li>Adboards Actualizados 2025</li>
                                <li>Relatos de Mariano Closs con equipos bolivianos</li>
                                <li>Plantilla, Kits y Faces Bolivia 1994</li>
                                <li>Intros de cada competición actualizada</li>
                                <li>Kits de Árbitros Bolivianos</li>
                                <li>* Futura actualizacion copa Paceña</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal PS4/PS5 -->
    <div class="modal fade" id="ps4" tabindex="-1" aria-labelledby="ps4Label" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ps4Label">Option File Airpatch 2025 PS4/PS5</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Carousel for PS4/PS5 -->
                            <div id="carouselPS4" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="img/ps4/A.png" class="d-block w-100" alt="PS4 Image 1">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="img/ps4/B.png" class="d-block w-100" alt="PS4 Image 2">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="img/ps4/C.png" class="d-block w-100" alt="PS4 Image 3">
                                    </div>

                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselPS4" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselPS4" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <!-- Thumbnails for PS4/PS5 -->
                            <div class="thumbnail-container">
                                <img src="img/ps4/A.png" class="thumbnail active" data-bs-target="#carouselPS4" data-bs-slide-to="0" alt="Thumbnail A">
                                <img src="img/ps4/B.png" class="thumbnail" data-bs-target="#carouselPS4" data-bs-slide-to="1" alt="Thumbnail B">
                                <img src="img/ps4/C.png" class="thumbnail" data-bs-target="#carouselPS4" data-bs-slide-to="2" alt="Thumbnail C">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3 class="font-bold text-lg mb-4">Características:</h3>
                            <ul class="description-list">
                                <li>Kits Actualizados 2025</li>
                                <li>Plantillas Actualizadas a 2025</li>
                                <li>Logos de Liga y Equipos Actualizado</li>
                                <li>Ligas Externas a Bolivia Actualizadas</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                    
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright © @irsoft - 2023</div>
                    </div>
                </div>
            </footer>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

        <script>
        fetch('obtener_datos.php')
            .then(response => response.json())
            .then(data => {
                const meses = [];
                const comprasPS4 = [];
                const comprasComputadora = [];
                const nombreMeses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

                data.forEach(item => {
                    const mes = `${nombreMeses[parseInt(item.mes) - 1]} ${item.año}`;
                    if (!meses.includes(mes)) {
                        meses.push(mes);
                    }
                    if (item.tipo === 'PS4/PS5') {
                        comprasPS4.push(parseInt(item.cantidad));
                    } else {
                        comprasComputadora.push(parseInt(item.cantidad));
                    }
                });

                const ctx = document.getElementById('grafico').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: meses,
                        datasets: [{
                            label: 'Compras PS4/PS5',
                            data: comprasPS4,
                            backgroundColor: '#e6ffe6',
                            borderColor: '#28a745',
                            borderWidth: 1
                        }, {
                            label: 'Compras Computadora',
                            data: comprasComputadora,
                            backgroundColor: '#e7f1ff',
                            borderColor: '#007bff',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true,
                                    stepSize: 5,
                                    precision: 0
                                }
                            }]
                        }
                    }
                });
            })
            .catch(error => console.error('Error al obtener los datos:', error));
        </script>
    </body>
</html>