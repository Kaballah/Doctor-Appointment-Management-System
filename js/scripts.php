<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>

<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../plugins/chart.js/Chart.min.js"></script>
<script src="../plugins/sparklines/sparkline.js"></script>
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>

<script src="../dist/js/pages/dashboard2.js"></script>

<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="../dist/js/adminlte.js"></script>
<script src="../plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<script src="../plugins/filterizr/jquery.filterizr.min.js"></script>


<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="../plugins/toastr/toastr.min.js"></script>
<!-- <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script> -->

<!-- <script src="../plugins/jsgrid/demos/db.js"></script> -->
<script src="../plugins/jsgrid/jsgrid.min.js"></script>

<!-- <?php 
    // include '../partials/connect.php';

    // $sql = "SELECT appointmentId AS ID, CONCAT(firstName, ' ', IFNULL(middleName, ''), ' ', lastName) AS Name, position AS Position, address AS Address, primaryEmail AS Email, primaryNumber AS Number, salutation, dob, secondaryNumber, secondaryEmail, specialization, workingHoursWeekdays, workingHoursWeekends, accountStatus, salary FROM users";
    // $result = $conn->query($sql);

    // echo '<script>';
    // echo 'var db = { clients: [';

    //     if ($result->num_rows > 0) {
    //         $clients = [];
    //         while ($row = $result->fetch_assoc()) {
    //             $clients[] = json_encode($row);
    //         }
    //         echo implode(',', $clients);
    //     }

    // echo '] };';
    // echo '</script>';

    // $conn->close();
?>

<script>
    $(function () {
        const originalData = db.clients;
        const noMatchMessageId = "noMatchMessage";

        $("#jsGrid1").jsGrid({
            // height: "100%",
            width: "100%",

            sorting: true,
            paging: true,
            pageSize: 10,
            pageButtonCount: 5,

            data: originalData,

            fields: [
                { name: "ID", type: "text", width: 50 },
                { name: "Name", type: "text", width: 100 },
                { name: "Position", type: "text", width: 50 },
                { name: "Address", type: "text", width: 100 },
                { name: "Email", type: "email", title: "Contact Info" }
            ],

            rowClick: function (args) {
                const clientData = args.item;

                displayClientDetails(clientData);
            }
        });

        $(".jsgrid-header-cell").on("click", function (e) {
            e.stopPropagation();
        });
        $(".jsgrid-pager").on("click", function (e) {
            e.stopPropagation();
        });

        $("#tableSearch").on("keyup", function () {
            const filter = this.value.toLowerCase();

            const filteredData = originalData.filter(item => {
                return (
                    item.ID.toString().toLowerCase().includes(filter) ||
                    item.Name.toLowerCase().includes(filter) ||
                    item.Position.toLowerCase().includes(filter) ||
                    item.Address.toLowerCase().includes(filter) ||
                    item.Email.toLowerCase().includes(filter)
                );
            });

            if (filteredData.length === 0) {
                $(`#${noMatchMessageId}`).remove();

                const noMatchMessage = $(`<div id="${noMatchMessageId}" style="text-align: center; color: red; margin: 20px;">No match recorded</div>`);
                $("#jsGrid1").after(noMatchMessage);
            } else {
                $(`#${noMatchMessageId}`).remove();
            }
            
            $("#jsGrid1").jsGrid("option", "data", filteredData);
            $("#jsGrid1").jsGrid("option", "pageIndex", 1);
        });

        function displayClientDetails(clientData) {
            const weekdayTimes = clientData.workingHoursWeekdays.split(' - ');
            const weekendTimes = clientData.workingHoursWeekends.split(' - ');

            const weekdayStart = convertTo24HourFormat(weekdayTimes[0]);
            const weekdayEnd = convertTo24HourFormat(weekdayTimes[1]);
            const weekendStart = convertTo24HourFormat(weekendTimes[0]);
            const weekendEnd = convertTo24HourFormat(weekendTimes[1]);

            $('#sal').val(clientData.salutation);
            $('#firstName').val(clientData.Name.split(' ')[0]);
            $('#middlename').val(clientData.Name.split(' ')[1]);
            $('#lastname').val(clientData.Name.split(' ')[2]);

            $('#dob').val(clientData.dob);
            $('#age').val(calculateAge(clientData.dob));

            $('#primaryNumber').val(clientData.Number);
            $('#secondaryNumber').val(clientData.secondaryNumber);
            $('#primaryEmail').val(clientData.Email);
            $('#secondaryEmail').val(clientData.secondaryEmail);
            $('#address').val(clientData.Address);

            $('#weekdayStart').val(weekdayStart);
            $('#weekdayEnd').val(weekdayEnd);
            $('#weekendStart').val(weekendStart);
            $('#weekendEnd').val(weekendEnd);
            $('#accountStatus').val(clientData.accountStatus);
            $('#salary').val(clientData.salary);

            $('#user-type').val(clientData.Position);
            $('#specialization').val(clientData.specialization);
        }

        function calculateAge(dob) {
            var birthDate = new Date(dob);
            var age = new Date().getFullYear() - birthDate.getFullYear();
            var m = new Date().getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && new Date().getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }

        function convertTo24HourFormat(time) {
            var timeParts = time.match(/(\d{1,2})\s*(am|pm)/i);
            if (!timeParts) return time;

            var hours = parseInt(timeParts[1]);
            var period = timeParts[2].toLowerCase();
            
            if (period === 'am' && hours === 12) {
                hours = 0;
            } else if (period === 'pm' && hours !== 12) {
                hours += 12;
            }

            return (hours < 10 ? '0' : '') + hours + ":00";
        }
    });
</script> -->

<!-- Skeleton Loader -->

<script>
    const card = document.getElementById("card");
    // card.classList.add("d-none");
    
    window.onload = function () {
        const loader = document.getElementById("skeletonLoader");
        

        loader.classList.add("d-none");
        card.classList.remove("d-none");
    };
</script>