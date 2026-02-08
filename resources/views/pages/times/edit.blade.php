@extends('app')
@section('title', 'Time Table '.$classe->libelle)
@section('link')
<style>
  
</style>
@endsection
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-12">
            @include('partials._alert')
            <div class="card radius-10 w-100">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-1 mb-0">
                    <h5 class="mb-0">Teachers</h5>
                    <h5>{{ $classe->libelle }}</h5>
                    <span style="float: right;">
                      <a href="{{ route('time.index', $classe->id) }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Return Back" style="border: none; border-radius: 3px">
                        <i class="lni lni-reply m-0" style="font-size: 17px"></i>
                      </a>
                    </span>
                </div>
                <form action="{{ route('time.update') }}" method="post">
                  @csrf
                  <div class="card-body col-xl-10 mx-auto">
                    <div class="table-responsive mt-1">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th class="text-center" scope="col" style="width: 5%">
                              <input type="checkbox" id="checkbox" class="form-check-input">
                            </th>
                            <th class="text-center" scope="col" style="width: 40%">Disciplines</th>
                            <th class="text-center" scope="col" style="width: 38%">Enseignants</th>
                            <th class="text-center" scope="col" style="width: 17%">Etat</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php $i = 1 @endphp
                          @foreach ($matters as $item)
                            <tr>
                              <td class="text-center">{{ $i }}</td>
                              <td class="text-left p-0  ">
                                <div class="input-group m-0">
                                  <span class="input-group-text" id="basic-addon1">
                                    <i class="fadeIn animated bx bx-slider m-0"></i>
                                  </span>
                                  <input type="hidden" name="order[]" value="{{ $i }}">
                                  <input type="text" class="form-control" value="{{ formatMatterUser($item['libelle'], $classe->autre, $classe->lv2) }}" disabled style="background: none">
                                </div>
                              </td>
                              <td class="text-center p-0">
                                <div class="input-group m-0">
                                  <span class="input-group-text"><i class="lni lni-user"></i></span>
                                  <select name="select[]" class="form-select selected m-0">
                                    <option value="nc">---</option>
                                    @foreach ($users as $user)
                                      <option value="{{ $item['id'].'_'.$user->id.'_'.$i }}" {{ userMatter($item['id'].'_'.$user->id.'_'.$i, $data) }}>
                                        {{ $user->civilite.' '.strtoupper($user->first_name).' '.ucwords($user->last_name) }}
                                      </option>
                                    @endforeach
                                  </select>
                                </div>
                              </td>
                              <td class="text-center p-0">
                                <div class="input-group m-0">
                                  <div class="input-group-text">
                                    <input type="radio" name="radio" class="form-check-input radio" data-val="{{ $i }}" value="{{ $i }}" {{ getProfPrincipal($i, $item['id'], $data) ? 'checked':null }}>
                                  </div>
                                  <input type="text" class="form-control label" id="label_{{ $i }}" value="{{ getProfPrincipal($i++, $item['id'], $data) ? 'Prof Principal':null }}" disabled style="background: none">
                                </div>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="m-0" id="btnDiv" style="display: none">
                      <hr class="my-3" style="margin: auto">
                      <input type="hidden" name="class" id="class" value="{{ $classe->id }}">
                      <div class="col-12 my-3 text-center">
                          <button class="btn btn-dark w-25" id="btnValid">Confirm ...</button>
                      </div>
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {

      $('#checkbox').on('click', function() {
        if($(this).is(':checked')){
          $('#btnDiv').show(500);
        }
        else{
          $('#btnDiv').hide(500);
        }
      });

      $('.radio').on('click', function() {
        $('.label').val('');
        $i = $(this).data('val');
        $('#label_'+$i).val('Prof Principal');
      })

    });
</script>
@endsection