<nav class="main-header navbar navbar-expand">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="javascript:void(0);" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- <div class="navbar-center">
        <form class="form-inline">
            <div class="input-group input-group-sm" style="box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div> -->

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <button id="date-btn" class="btn btn-outline-primary" style="font-weight: bold; border-radius: 20px;">
                <span id="current-date"></span>
                <i class="fas fa-calendar-alt ml-2"></i>
            </button>

            <!-- <div id="calendar-container" class="dropdown-menu p-3" style="display: none; position: absolute; right: 0; top: 60px; z-index: 1000;">
                <div id="calendar" class="mb-3" style="font-weight: bold;"></div>
            </div> -->
        </li>
    </ul>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dateBtn = document.getElementById('date-btn');
        const currentDateSpan = document.getElementById('current-date');
        const calendarContainer = document.getElementById('calendar-container');
        const calendar = document.getElementById('calendar');

        let currentDate = new Date();

        function formatDate(date) {
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = date.getFullYear();
            return `${day}/${month}/${year}`;
        }

        currentDateSpan.textContent = formatDate(currentDate);
    });
</script>