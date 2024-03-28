@push('js')
    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <x-chart_script name="barChart" target="barChart" type="bar" labelcolor="white" :label="['jan','feb','mar']" :data="[10,20,30]" :color="['blue']"/>
    <x-chart_script name="barChart2" target="barChart2" type="bar" labelcolor="white" :label="['2020','2021','2022']" :data="[10,20,30]" :color="['red']"/>
    <x-map_dashboard mapname="dashmap" mapid="{{$map_id}}" :data="$mapsawah"/>
@endpush
<div>
    <x-content_header name="Dashboard" >
        <li class="breadcrumb-item active">Dashboard</a></li>
    </x-content_header>
    <div class="row mx-1">
        <x-carousel_info :data="$infobanner" />
    </div>
    <div class="row mx-1">
        <x-card_section2 name="Sebaran Lokasi Sawah" type="primary" width="12" order="1" smallorder="1">
            <div wire:ignore id="dashmap-{{$map_id}}" class="w-100 rounded bg-blank" style="height: 500px;"></div>
        </x-card-section2>
    </div>      
    <div class="row mx-1">
        <x-info_box icon="fas fa-seedling" message="Sawah" value="10" type="success"/>
        <x-info_box icon="fas fa-users" message="Pawongan" value="5" type="primary"/>
        <x-info_box icon="fas fa-money-bill-wave" message="Nilai Asset" value="1M" type="warning"/>
        <x-info_box icon="fas fa-coins" message="Nilai Lanja" value="1K" type="info"/>
    </div>
    <div class="row mx-1">
        <x-info_box2 icon="fas fa-wallet" message="Nilai Lanja Tahun 2022" value="10" type="success"/>
        <x-info_box2 icon="fas fa-donate" message="Nilai Zakat Tahun 2022" value="10" type="primary"/>
        <x-info_box2 icon="fas fa-file-invoice-dollar" message="Nilai PBB Tahun 2022" value="10" type="warning"/>
    </div>
    <div class="row mx-1">
        <x-card_chart width="6" type="warning" title="Grafik Lanja Tahun 2022" idbarchart="barChart"/>
        <x-card_chart width="6" type="info" title="Grafik Lanja per Tahun" idbarchart="barChart2"/>
    </div>
    <div class="row mx-1">
        <x-card_list width="6" title="Pawongan Terbaik">
            <x-card_listitem photo="{{asset('dist/img/default-150x150.png')}}" link="#" title="Asep" desc="Sawah Mundu" value="1.000.000" />
            <x-card_listitem photo="{{asset('dist/img/default-150x150.png')}}" link="#" title="Bobi" desc="Sawah Karangampel" value="2.000.000" />
            <x-slot:footer>
                <a href="#" class="uppercase">View All</a>
            </x-slot> 
        </x-card_list>
        <x-card_list width="6" title="Tunggakan Pawongan">
            <x-card_listitem photo="{{asset('dist/img/default-150x150.png')}}" link="#" title="Asep" desc="Sawah Mundu" value="1.000.000" />
            <x-card_listitem photo="{{asset('dist/img/default-150x150.png')}}" link="#" title="Bobi" desc="Sawah Karangampel" value="2.000.000" />
            <x-slot:footer>
                <a href="#" class="uppercase">View All</a>
            </x-slot> 
        </x-card_list>
    </div>
</div>