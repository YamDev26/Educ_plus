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
                    <h5 class="mb-0">{{ $data ? 'Edit':'Add' }} Time table</h5>
                    <h5>{{ $classe->libelle }}</h5>
                    <span style="float: right;">
                      <a href="{{ route('time.index', $classe->id) }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Return Back" style="border: none; border-radius: 3px">
                        <i class="lni lni-reply m-0" style="font-size: 17px"></i>
                      </a>
                    </span>
                </div>
                <form action="{{ route('time.store') }}" method="post">
                  @csrf
                  <div class="card-body">
                    <input type="hidden" name="class" id="class" value="{{ $classe->id }}">
                    <div class="table-responsive mt-4">
                      <table class="table table-striped table-bordered" style="border: 1px solid white">
                        <thead>
                          <tr class="table-dark" style="border: 1px solid white">
                            <th class="text-center" scope="col" style="border-right: 1px solid white"></th>
                            @foreach ($days as $day)
                              <th class="text-center" scope="col" data-day ="{{ $day->id }}" style="width: 17%; border-right: 1px solid white">{{ ucfirst($day->libelle) }}</th>
                            @endforeach
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($times['time1'] as $time)
                            <tr class="tableBasique">
                              <td class="text-center">{{ $time->debut }}</td>
                              <td class="text-center p-0">
                                <select name="select[]" class="form-select selected m-0">
                                  <option value="nc">---</option>
                                  @foreach ($matters as $matter)
                                    <option value="{{ $matter['id'].'_'.$time->id.'_1_1' }}" {{ getMatter($matter['id'].'_'.$time->id.'_1', $martin) }}>{{ $matter['abbreviat'] }}</option>
                                  @endforeach
                                </select>
                              </td>
                              <td class="text-center p-0">
                                <select name="select[]" class="form-select selected m-0">
                                  <option value="nc">---</option>
                                  @foreach ($matters as $matter)
                                    <option value="{{ $matter['id'].'_'.$time->id.'_2_1' }}" {{ getMatter($matter['id'].'_'.$time->id.'_2', $martin) }}>{{ $matter['abbreviat'] }}</option>
                                  @endforeach
                                </select>
                              </td>
                              <td class="text-center p-0">
                                <select name="select[]" class="form-select selected m-0" >
                                  <option value="nc">---</option>
                                  @foreach ($matters as $matter)
                                    <option value="{{ $matter['id'].'_'.$time->id.'_3_1' }}" {{ getMatter($matter['id'].'_'.$time->id.'_3', $martin) }}>{{ $matter['abbreviat'] }}</option>
                                  @endforeach
                                </select>
                              </td>
                              <td class="text-center p-0">
                                <select name="select[]" class="form-select selected m-0" >
                                  <option value="nc">---</option>
                                  @foreach ($matters as $matter)
                                    <option value="{{ $matter['id'].'_'.$time->id.'_4_1' }}" {{ getMatter($matter['id'].'_'.$time->id.'_4', $martin) }}>{{ $matter['abbreviat'] }}</option>
                                  @endforeach
                                </select>
                              </td>
                              <td class="text-center p-0">
                                <select name="select[]" class="form-select selected m-0" >
                                  <option value="nc">---</option>
                                  @foreach ($matters as $matter)
                                    <option value="{{ $matter['id'].'_'.$time->id.'_5_1' }}" {{ getMatter($matter['id'].'_'.$time->id.'_5', $martin) }}>{{ $matter['abbreviat'] }}</option>
                                  @endforeach
                                </select>
                              </td>
                            </tr>
                          @endforeach
                          <tr>
                            <td colspan="7" class="text-center">
                              <div class="d-flex justify-content-around">
                                <span>Après Midi</span>
                                <span>Après Midi</span>
                              </div>
                            </td>
                          </tr>
                          @foreach ($times['time2'] as $time)
                            <tr class="tableBasique">
                              <td class="text-center">{{ $time->debut }}</td>
                              <td class="text-center p-0">
                                <select name="select[]" class="form-select selected m-0">
                                  <option value="nc">---</option>
                                  @foreach ($matters as $matter)
                                    <option value="{{ $matter['id'].'_'.$time->id.'_1_2' }}" {{ getMatter($matter['id'].'_'.$time->id.'_1', $soirs) }}>{{ $matter['abbreviat'] }}</option>
                                  @endforeach
                                </select>
                              </td>
                              <td class="text-center p-0">
                                <select name="select[]" class="form-select selected m-0">
                                  <option value="nc">---</option>
                                  @foreach ($matters as $matter)
                                    <option value="{{ $matter['id'].'_'.$time->id.'_2_2' }}" {{ getMatter($matter['id'].'_'.$time->id.'_2', $soirs) }}>{{ $matter['abbreviat'] }}</option>
                                  @endforeach
                                </select>
                              </td>
                              <td class="text-center p-0">
                                {{-- <select class="form-select selected m-0">
                                  <option selected=" ">---</option>
                                  @foreach ($matters as $matter)
                                    <option value="{{ $matter['id'].'_'.$time->id.'_3_2' }}" {{ getMatter($matter['id'].'_'.$time->id.'_3', $soirs) }}>{{ $matter['abbreviat'] }}</option>
                                  @endforeach
                                </select> --}}
                              </td>
                              <td class="text-center p-0">
                                <select name="select[]" class="form-select selected m-0">
                                  <option value="nc">---</option>
                                  @foreach ($matters as $matter)
                                    <option value="{{ $matter['id'].'_'.$time->id.'_4_2' }}" {{ getMatter($matter['id'].'_'.$time->id.'_4', $soirs) }}>{{ $matter['abbreviat'] }}</option>
                                  @endforeach
                                </select>
                              </td>
                              <td class="text-center p-0">
                                <select name="select[]" class="form-select selected m-0">
                                  <option value="nc">---</option>
                                  @foreach ($matters as $matter)
                                    <option value="{{ $matter['id'].'_'.$time->id.'_5_2' }}" {{ getMatter($matter['id'].'_'.$time->id.'_5', $soirs) }}>{{ $matter['abbreviat'] }}</option>
                                  @endforeach
                                </select>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <hr class="my-3" style="margin: auto">
                    <div class="col-12 my-3 text-center">
                        <button class="btn btn-dark w-25" id="btnValid">Confirm ...</button>
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
      
      $('.selected').on('change', function() {
        $val = $(this);
        if($(this).val()){
          $.ajax({
            url: "{{ route('time.search') }}",
            method: "GET",
            data: { 
              val: $(this).val()
            },
            dataType: "json",
            success: function(dts) {
              $($val).css({"background": dts == 200 ? "red":"transparent"});
              if(dts == 200){
                $('#btnValid').prop('disabled',true);
                $msg = 'L\'enseignant intervient dans une autre classe à cette heure';
                getNotify('info', 'bx bx-error', $msg);
              }
              else{
                $('#btnValid').prop('disabled',false);
              }
            }
          });
        }
      });



      function getNotify($type, $icon, $message){
        Lobibox.notify($type, {
          pauseDelayOnHover: true,
          continueDelayOnInactiveTab: false,
          position: 'top right',
          icon: $icon,
          msg: $message
        });
      }

    });
</script>
@endsection