<script>
document.addEventListener('livewire:initialized', function () {
    $(document).ready(function(){
        const {{ $name }} = new Chart(document.getElementById( "{{ $target }}" ).getContext('2d'), {
        type: "{{ $type }}",
        data: 
            {
                labels: @js($label),
                datasets: [
                {
                    data: @js($data),
                    backgroundColor : @js($color)
                }
                ]
            },
        plugins: [ChartDataLabels],
        options: 
            {
                maintainAspectRatio : false,
                responsive : true,
                plugins:{
                    legend:{
                        display:false
                    },
                    datalabels: {
                        color: "{{ $labelcolor }}"
                    }
                },
                scales: {
                    y:{
                        beginAtZero: true,
                        ticks: {
                            precision:0,
                        }
                    },
                }
            }
        })
    });
})
    
</script>