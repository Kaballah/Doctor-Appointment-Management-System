<?php 
    $currentPage = 'search';
    require "../partials/sidenav.php";
    include '../partials/header.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Search | Halisi Family Home</title>

        <?php include '../styles/styles.php'?>
    </head>

    <body>
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Search</h1>
                        </div>
          
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Search</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <div class="card">
                <!-- <div class="card-header">
                    <h3 class="card-title">DataTable with default features</h3>
                </div> -->
                
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Rendering engine</th>
                                <th>Browser</th>
                                <th>Platform(s)</th>
                                <th>Engine version</th>
                                <th>CSS grade</th>
                            </tr>
                        </thead>
                  
                        <tbody>
                            <tr>
                                <td>Trident</td>
                                <td>Internet Explorer 5.5</td>
                                <td>Win 95+</td>
                                <td>5.5</td>
                                <td>A</td>
                            </tr>
                            
                            <tr>
                                <td>Trident</td>
                                <td>Internet Explorer 6</td>
                                <td>Win 98+</td>
                                <td>6</td>
                                <td>A</td>
                            </tr>
                            
                            <tr>
                                <td>Trident</td>
                                <td>Internet Explorer 7</td>
                                <td>Win XP SP2+</td>
                                <td>7</td>
                                <td>A</td>
                            </tr>
                            
                            <tr>
                                <td>Gecko</td>
                                <td>Firefox 3.0</td>
                                <td>Win 2k+ / OSX.3+</td>
                                <td>1.9</td>
                                <td>A</td>
                            </tr>
                            
                            <tr>
                                <td>Gecko</td>
                                <td>Camino 1.0</td>
                                <td>OSX.2+</td>
                                <td>1.8</td>
                                <td>A</td>
                            </tr>
                            
                            <tr>
                                <td>Gecko</td>
                                <td>Netscape 7.2</td>
                                <td>Win 95+ / Mac OS 8.6-9.2</td>
                                <td>1.7</td>
                                <td>A</td>
                            </tr>
                            
                            <tr>
                                <td>Gecko</td>
                                <td>Epiphany 2.20</td>
                                <td>Gnome</td>
                                <td>1.8</td>
                                <td>A</td>
                            </tr>
                            
                            <tr>
                                <td>Webkit</td>
                                <td>Safari 1.2</td>
                                <td>OSX.3</td>
                                <td>125.5</td>
                                <td>A</td>
                            </tr>

                            <tr>
                                <td>Webkit</td>
                                <td>Safari 1.3</td>
                                <td>OSX.3</td>
                                <td>312.8</td>
                                <td>A</td>
                            </tr>

                            <tr>
                                <td>Webkit</td>
                                <td>Safari 2.0</td>
                                <td>OSX.4+</td>
                                <td>419.3</td>
                                <td>A</td>
                            </tr>

                            <tr>
                                <td>Presto</td>
                                <td>Opera 7.0</td>
                                <td>Win 95+ / OSX.1+</td>
                                <td>-</td>
                                <td>A</td>
                            </tr>

                            <tr>
                                <td>Presto</td>
                                <td>Opera 7.5</td>
                                <td>Win 95+ / OSX.2+</td>
                                <td>-</td>
                                <td>A</td>
                            </tr>

                            <tr>
                                <td>Presto</td>
                                <td>Nokia N800</td>
                                <td>N800</td>
                                <td>-</td>
                                <td>A</td>
                            </tr>

                            <tr>
                                <td>Presto</td>
                                <td>Nintendo DS browser</td>
                                <td>Nintendo DS</td>
                                <td>8.5</td>
                                <td>C/A<sup>1</sup></td>
                            </tr>

                            <tr>
                                <td>KHTML</td>
                                <td>Konqureror 3.1</td>
                                <td>KDE 3.1</td>
                                <td>3.1</td>
                                <td>C</td>
                            </tr>

                            <tr>
                                <td>Tasman</td>
                                <td>Internet Explorer 4.5</td>
                                <td>Mac OS 8-9</td>
                                <td>-</td>
                                <td>X</td>
                            </tr>

                            <tr>
                                <td>Tasman</td>
                                <td>Internet Explorer 5.1</td>
                                <td>Mac OS 7.6-9</td>
                                <td>1</td>
                                <td>C</td>
                            </tr>

                            <tr>
                                <td>Misc</td>
                                <td>NetFront 3.1</td>
                                <td>Embedded devices</td>
                                <td>-</td>
                                <td>C</td>
                            </tr>

                            <tr>
                                <td>Other browsers</td>
                                <td>All others</td>
                                <td>-</td>
                                <td>-</td>
                                <td>U</td>
                            </tr>
                        </tbody>
                  
                        <tfoot>
                            <tr>
                                <th>Rendering engine</th>
                                <th>Browser</th>
                                <th>Platform(s)</th>
                                <th>Engine version</th>
                                <th>CSS grade</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <footer class="footer" style="bottom: 0; display: flex; position: absolute; justify-content: space-between;">
            <?php include '../partials/footer.php'?>
        </footer>

        <?php include '../js/scripts.php' ?>

        <script>
            $(function () {
                $("#example1").DataTable({
                    "responsive": true, "lengthChange": false, "autoWidth": false,
                    "buttons": ["csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                
                $('#example2').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true,
                });
            });
        </script>
    </body>
</html>