<div class="sidebar" data-color="blue" data-image="/cms-templates/light-bootstrap-dashboard-master/assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="/admin" class="simple-text">
                BASAR
            </a>
        </div>

        <ul class="nav">
            <li>
                <a href="/admin">
                    <i class="pe-7s-graph"></i>
                    <p>Панель управления</p>
                </a>
            </li>
            @if(Auth::user()->is_admin)
                <li>
                    <a href="/admin/users">
                        <i class="pe-7s-user"></i>
                        <p>Пользователи</p>
                    </a>
                </li>
            @endif
            @if(Auth::user()->is_active)
                <li>
                    <a href="/admin/tables">
                        <i class="pe-7s-note2"></i>
                        <p>Таблицы</p>
                    </a>
                </li>
            @endif

        </ul>
    </div>
</div>