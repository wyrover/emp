@inject('menu','App\Estar\Composers\Estar')
    <aside class="left-panel">

        <div class="text-center">
            <img class="responsive" src="/img/logo.png"  alt="...">
            <h5 class="current-time">{{$menu->showTime()}}</h5>
        </div>


        <nav class="navigation" id="sidemenu">
            <ul class="list-unstyled">
                    {{$menu->makeMenu()}}
            </ul>
        </nav>

    </aside>
