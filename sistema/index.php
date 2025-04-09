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
            body {
                background-color: #f5f7fa;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            .sidebar {
                background: #ffffff;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.05);
                padding: 20px;
                height: fit-content;
            }
            .content-card {
                background: #ffffff;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.05);
                padding: 20px;
            }
            .stat-box {
                padding: 10px;
                border-radius: 6px;
                margin-bottom: 10px;
                transition: all 0.2s;
                text-align: center;
            }
            .stat-box:hover {
                opacity: 0.9;
            }
            .stat-box h6 {
                margin-bottom: 5px;
                /* color: #495057; */
                font-weight: 600;
                font-size: 0.95rem;
            }
            .stat-box span {
                font-size: 1.1rem;
                font-weight: 700;
            }
            .table-compact {
                font-size: 0.9rem;
                margin-bottom: 0;
            }
            .table-compact th, .table-compact td {
                padding: 8px;
                border: none;
            }
            .table-compact thead th {
                background: #e9ecef;
                color: #495057;
            }
            .section-title {
                color: #212529;
                font-weight: 600;
                margin-bottom: 15px;
                font-size: 1.25rem;
            }
            .small-text {
                font-size: 0.8rem;
                color: #6c757d;
            }
            /* Colores diferenciados */
            .pc-color { color: #007bff; } /* Azul para PC */
            .play-color { color: #28a745; } /* Verde para PS4/PS5 */
            .pending-alert { 
                background: linear-gradient(45deg, #ff6b6b, #ff8787); 
                color: white; 
                box-shadow: 0 2px 6px rgba(255, 107, 107, 0.3); 
            }
            .pending-ok { 
                background: linear-gradient(45deg,rgb(23, 184, 136), #48c9b0); 
                color: white; 
                box-shadow: 0 2px 6px rgba(23, 162, 184, 0.3); 
            }
            .approved-box { background: #f8f9fa; }
            .total-box { background: #f8f9fa; }
            .pc-box { background: #e7f1ff; }
            .play-box { background: #e6ffe6; }
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
                        <div class="col-lg-6">
                            <div class="sidebar">
                                <div class="section-title"><i class="bi bi-bar-chart-line me-1"></i> Estadísticas</div>
                                
                                <div class="row g-3">
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="stat-box <?php echo $PENDIENTES > 0 ? 'pending-alert' : 'pending-ok'; ?>">
                                            <h6>Compras Pendientes</h6>
                                            <span><?php echo $PENDIENTES;?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="stat-box approved-box">
                                            <h6>Compras Aprobadas</h6>
                                            <span class="text-success"><?php echo $total_compras;?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <div class="stat-box total-box">
                                            <h6>Total Acumulado</h6>
                                            <span class="text-dark"><?php echo number_format($saldo_total,2,'.',',');?> Bs</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-3">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="stat-card pc-card">
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
                                    <div class="stat-card play-card">
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
                        <div class="col-lg-6">
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
                            <div class="content-card">
                                <div class="section-title"><i class="bi bi-shop me-1"></i> Tienda</div>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <img src="../assets/images/AIR/portada.png" class="img-fluid rounded" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row g-3">
                                            <div class="col-sm-6">
                                                <div class="stat-box pc-box text-center">
                                                    <h6>AIRPATCH 2024 PC</h6>
                                                    <p class="mb-2"><strong class="pc-color">50 Bs</strong> <small class="text-muted">/anual</small></p>
                                                    <ul class="list-unstyled small mb-3">
                                                        <li>Temporada 2024 liga boliviana</li>
                                                        <li>Copa Simón Bolívar</li>
                                                        <li>Libertadores 2024</li>
                                                    </ul>
                                                    <a class="btn btn-sm btn-outline-danger w-100 mb-2" href="compras/"><i class="bi bi-bag"></i> Comprar</a>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary w-100" data-bs-toggle="modal" data-bs-target="#pc">
                                                        <i class="bi bi-eye"></i> Novedades
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="stat-box play-box text-center">
                                                    <h6>OPTION FILE PS4/PS5</h6>
                                                    <p class="mb-2"><strong class="play-color">40 Bs</strong> <small class="text-muted">/anual</small></p>
                                                    <ul class="list-unstyled small mb-3">
                                                        <li>Temporada 2024 liga boliviana</li>
                                                        <li>Plantillas 2024</li>
                                                        <li>Libertadores 2024</li>
                                                    </ul>
                                                    <a class="btn btn-sm btn-outline-danger w-100 mb-2" href="compras/"><i class="bi bi-bag"></i> Comprar</a>
                                                    <button type="button" class="btn btn-sm btn-outline-secondary w-100" data-bs-toggle="modal" data-bs-target="#ps4">
                                                        <i class="bi bi-eye"></i> Novedades
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
                    <div class="modal fade" id="pc" tabindex="-1" aria-labelledby="pc" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Airpatch 2024 PC</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-6"><img src="img/1.png" alt="" class="img-fluid"></div>
                                        <div class="col-sm-6"><img src="img/A.png" alt="" class="img-fluid"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="ps4" tabindex="-1" aria-labelledby="ps4" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Option File Airpatch 2024 PS4/PS5</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-6"><img src="img/2.png" alt="" class="img-fluid"></div>
                                        <div class="col-sm-6"><img src="img/B.png" alt="" class="img-fluid"></div>
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