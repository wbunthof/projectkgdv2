<div class="progress">
    <div class="progress-bar" role="progressbar" style="width: {{round(($deel/$geheel)*100) }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
      <span @if(round(($deel/$geheel)*100) < 10)class="text-dark" @endif>{{round(($deel/$geheel)*100)}}% voltooid</span>
    </div>
</div>
<br>
