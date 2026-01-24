
@extends('app')
@section('title', ($data ? 'Edit':'Add').' Teacher')
@section('link')

@endsection
@section('content')
<div class="page-content">
    <div class="row">
        <div class="col-12 px-lg-2">
            @include('partials._alert')
            <div class="card radius-10 w-100">
                <div class="card-header d-flex justify-content-between flex-wrap gap-2 pt-3 pb-2 mb-0">
                  <h5 class="mb-0">{{ $data ? 'Edit':'Add' }} - Teacher</h5>
                  <span style="font-size: 12px">Les champs avec Asterisk (<strong class="text-danger">*</strong>) sont obligatoires</span>
                  <span style="float: right;">
                    <a href="{{ route('teacher.index') }}" class="btn btn-outline-light py-0 px-2 mb-1" title="Return Back" style="border: none; border-radius: 3px">
                      <i class="lni lni-reply m-0" style="font-size: 17px"></i>
                    </a>
                  </span>
                </div>
                <div class="card-body">
                  <form action="{{ route($data ? 'teacher.update':'teacher.store', $data ? $data->id:'') }}" method="post">
                    @csrf
                    @method($data ? 'put':'post')
                    <div class="card">
                      <div class="card-body">
                        <div class="row g-3 p-2">
                          <div class="col-6 mb-2">
                            <label for="matter" class="form-label">Matière Enseignée<span class="text-danger">*</span> :</label>
                            <input type="text" name="matter" id="matter" class="form-control @error('matter') is-invalid @enderror" value="{{ old('matter', $data ? $data->matter:'') }}" placeholder="Matière Enseignée">
                            @error('matter')
                              <span class="form-bar text-danger" role="alert">
                                {{$message}}
                              </span>
                            @enderror
                          </div>
                          <div class="col-3 mb-2" style="display: {{ $data ? 'block':'none' }}">
                            <label class="form-label">Statut<span class="text-danger">*</span> :</label><br>
                            <span class="mr-3">
                              <input class="form-check-input" type="radio" name="status" id="actif" value="1" {{ old('status') == '1' ? 'checked' : '' }} {{ $data ? ($data->actif == '1' ? 'checked':''):'disabled' }}>
                              <label class="form-check-label" for="actif">Actif</label>
                            </span>
                            <span class="m-3">
                              <input class="form-check-input" type="radio" name="status" id="inactif" value="0" {{ old('status') == '0' ? 'checked' : '' }} {{ $data ? ($data->actif == '0' ? 'checked':''):'disabled' }}>
                              <label class="form-check-label" for="inactif">Inactif</label>
                            </span>
                          </div>
                          <div class="col-3 mb-2">
                            <label class="form-label">Civilité<span class="text-danger">*</span> :</label><br>
                            <span class="mr-3">
                              <input class="form-check-input" type="radio" name="civilite" id="m" value="M" {{ old('sexe') == 'M' ? 'checked' : '' }} {{ $data ? ($data->civilite == 'M' ? 'checked':''):'checked' }}>
                              <label class="form-check-label" for="m">Monsieur</label>
                            </span>
                            <span class="m-3">
                              <input class="form-check-input" type="radio" name="civilite" id="mme" value="Mme" {{ old('sexe') == 'Mme' ? 'checked' : '' }} {{ $data ? ($data->civilite == 'Mme' ? 'checked':''):'' }}>
                              <label class="form-check-label" for="mme">Madame</label>
                            </span>
                            @error('civilite')
                              <span class="form-bar text-danger" role="alert">
                                {{$message}}
                              </span>
                            @enderror
                          </div>
                          <div class="col-6 mb-2">
                            <label for="first_name" class="form-label">Nom<span class="text-danger">*</span> :</label>
                            <input type="text" name="first_name" id="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name', $data ? $data->first_name:'') }}" placeholder="Nom Enseignant">
                            @error('first_name')
                              <span class="form-bar text-danger" role="alert">
                                {{$message}}
                              </span>
                            @enderror
                          </div>
                          <div class="col-6 mb-2">
                            <label for="last_name" class="form-label">Prenoms<span class="text-danger">*</span> :</label>
                            <input type="text" name="last_name" id="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name', $data ? $data->last_name:'') }}" placeholder="Prenoms Enseignant">
                            @error('last_name')
                              <span class="form-bar text-danger" role="alert">
                                {{$message}}
                              </span>
                            @enderror
                          </div>
                          <div class="col-6 mb-2">
                            <label for="piece" class="form-label">Pièce Administrative<span class="text-danger">*</span> :</label>
                            <select name="piece" class="form-select" id="piece">
                              <option value="">Select Pièce</option>
                              @foreach ($pieces as $piece)
                                <option value="{{ $piece }}" {{ old('piece') == $piece ? 'selected':'' }} {{ $data ? ($data->piece == $piece ? 'selected':''):'' }}>{{ ucwords($piece) }}</option>
                              @endforeach
                            </select>
                            @error('piece')
                              <span class="form-bar text-danger" role="alert">
                                {{$message}}
                              </span>
                            @enderror
                          </div>
                          <div class="col-6 mb-2">
                            <label for="num_piece" class="form-label">Numéro Pièce<span class="text-danger">*</span> :</label>
                            <input type="text" name="num_piece" id="num_piece" class="form-control @error('num_piece') is-invalid @enderror" value="{{ old('num_piece', $data ? $data->num_piece:'') }}" placeholder="Numéro de la pièce">
                            @error('num_piece')
                              <span class="form-bar text-danger" role="alert">
                                {{$message}}
                              </span>
                            @enderror
                          </div>
                          <div class="col-6 mb-2">
                            <label for="email" class="form-label">Adresse Email<span class="text-danger">*</span> :</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $data ? $data->email:'') }}" placeholder="Adresse Email">
                            @error('email')
                              <span class="form-bar text-danger" role="alert">
                                {{$message}}
                              </span>
                            @enderror
                          </div>
                          <div class="col-6 mb-2">
                            <div class="row">
                              <div class="col-6">
                                <label for="contact1" class="form-label">Contact 1<span class="text-danger">*</span> :</label>
                                <input type="text" name="contact1" id="contact1" class="form-control number @error('contact1') is-invalid @enderror" value="{{ old('contact1', $data ? $data->contact1:'') }}" placeholder="Contact 1">
                                @error('contact1')
                                  <span class="form-bar text-danger" role="alert">
                                    {{$message}}
                                  </span>
                                @enderror
                              </div>
                              <div class="col-6">
                                <label for="contact2" class="form-label">Contact 2 :</label>
                                <input type="text" name="contact2" id="contact2" class="form-control number @error('contact2') is-invalid @enderror" value="{{ old('contact2', $data ? $data->contact2:'') }}" placeholder="Contact 2">
                                @error('contact2')
                                  <span class="form-bar text-danger" role="alert">
                                    {{$message}}
                                  </span>
                                @enderror
                              </div>
                            </div>
                          </div>
                          <div class="col-6 mb-2">
                            <label for="niveau" class="form-label">Niveau d'Etude<span class="text-danger">*</span> :</label>
                            <select name="niveau" class="form-select" id="niveau">
                              <option value="">Select Niveau</option>
                              @php $i = 1; @endphp
                              @while ($i <= 5)
                                <option value="BAC+{{ $i }}" {{ old('niveau') == ('BAC+'.$i) ? 'selected':'' }} {{ $data ? ($data->niveau == ('BAC+'.$i) ? 'selected':''):'' }}>BAC+{{ $i }}</option>
                                @php $i++ @endphp
                              @endwhile
                            </select>
                            @error('niveau')
                              <span class="form-bar text-danger" role="alert">
                                {{$message}}
                              </span>
                            @enderror
                          </div>
                          <div class="col-6 mb-2">
                            <label for="diplome" class="form-label">Dernier Diplôme<span class="text-danger">*</span> :</label>
                            <input type="text" name="diplome" id="diplome" class="form-control @error('diplome') is-invalid @enderror" value="{{ old('diplome', $data ? $data->diplome:'') }}" placeholder="Dernier Diplome">
                            @error('diplome')
                              <span class="form-bar text-danger" role="alert">
                                {{$message}}
                              </span>
                            @enderror
                          </div>
                          <div class="col-6">
                            <div class="row">
                              <div class="col-5">
                                <label class="form-label">Autorisation d'enseigné<span class="text-danger">*</span> :</label><br>
                                <span class="mr-3">
                                  <input class="form-check-input" type="radio" name="autorise" id="oui" value="oui" checked>
                                  <label class="form-check-label" for="oui">Oui</label>
                                </span>
                                <span class="m-3">
                                  <input class="form-check-input" type="radio" name="autorise" id="non" value="non">
                                  <label class="form-check-label" for="non">Non</label>
                                </span>
                                @error('autorise')
                                  <span class="form-bar text-danger" role="alert">
                                    {{$message}}
                                  </span>
                                @enderror
                              </div>
                              <div class="col-7">
                                <label for="num_autorise" class="form-label">Numero autorisation :</label>
                                <input type="text" name="num_autorise" id="num_autorise" class="form-control @error('num_autorise') is-invalid @enderror" value="{{ old('num_autorise', $data ? $data->num_autorise:'') }}" placeholder="Numéro Autorisation">
                                @error('num_autorise')
                                  <span class="form-bar text-danger" role="alert">
                                    {{$message}}
                                  </span>
                                @enderror
                              </div>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="row">
                              <div class="col-5">
                                <label class="form-label">Embauche<span class="text-danger">*</span> :</label><br>
                                <span class="mr-3">
                                  <input class="form-check-input" type="radio" name="type" id="permanant" value="permanant" checked>
                                  <label class="form-check-label" for="permanant">Permanant</label>
                                </span>
                                <span class="m-3">
                                  <input class="form-check-input" type="radio" name="type" id="vacataire" value="vacataire" {{ $data ? ($data->profil == 'vacataire' ? 'checked':''):'' }}>
                                  <label class="form-check-label" for="vacataire">Vacataire</label>
                                </span>
                                @error('type')
                                  <span class="form-bar text-danger" role="alert">
                                    {{$message}}
                                  </span>
                                @enderror
                              </div>
                              <div class="col-7">
                                <label for="number" class="form-label">Année d'Enseignement<span class="text-danger">*</span> :</label>
                                <input type="text" name="number" id="number" class="form-control number @error('number') is-invalid @enderror" value="{{ old('number', $data ? $data->anciennete:'') }}" placeholder="Année d'Enseignement">
                                @error('number')
                                  <span class="form-bar text-danger" role="alert">
                                    {{$message}}
                                  </span>
                                @enderror
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <div class="text-center">
                      <button type="submit" class="btn btn-dark w-25">Valider ...</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

<script>
    $(document).ready(function() {

      // Autoriser les touches numériques (0-9) et la touche backspace (code 8)
      $('.number').on('keypress', function(e) {
        var key = e.which || e.keyCode;
        if ((key >= 48 && key <= 57) || key === 8 || key === 46 || key === 127) {
          return true;
        } else {
          e.preventDefault();
        }
      });

      $('input[name="autorise"]').on('click', function(){
        $('#num_autorise').prop('disabled', $(this).val() == 'oui' ? false:true);
      })

    });
</script>
@endsection