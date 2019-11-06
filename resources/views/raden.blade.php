{{--  #
      # Code van Wouter
      #
      # --}}

@if (!empty($data))
  <table class="table table-hover">
    <tbody>
      @foreach ($data as $lid)
        <tr onclick="inputsVullen(this)">
          <td class="id">{{$lid->leden_id}}</td>
          <td class="voorletter">{{$lid->voorletter}}</td>
          <td class="achternaam">{{$lid->achternaam}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@else
  Geen leden gevonden, mocht het niet lukken om het lid te vinden graag een mail sturen naar nieuwlid@pure-air.nl
@endif
