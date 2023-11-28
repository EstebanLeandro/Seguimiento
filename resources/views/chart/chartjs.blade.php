@extends ('layouts.admin')
@section ('contenido')
<div>
  <canvas id="propuestas"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('propuestas');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['descri_actividades', 'estado', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: 'descri_actividades',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

@endsection