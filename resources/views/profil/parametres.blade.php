@extends('layouts.maindo')

@section('titre', $user['first_name'] . ' - Parametres de compte')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <h1 class="mb-2 text-3xl font-bold">Paramètres du compte</h1>
                </div>
            </div>
        </div>

        @if (Session::has('message'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                {{ Session::get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach
        @endif

        @if (Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ Session::get('error') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-4">
                <h3 class="mb-2 text-2xl font-bold">Profil</h3>
                <span class="mb-3 text-justify" style="padding-top:-3px;">Mettez à jour les informations de profil de
                    votre compte et
                    adresse e-mail.<br><br>
                    Lorsque vous modifiez votre adresse e-mail, vous devez vérifier votre adresse e-mail sinon le compte
                    sera bloqué</span>
            </div>

            <div class="col-lg-8 pt-0 text-center">
                <div class="card mt-md-3 mb-5 rounded bg-white py-4" style="box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175)">

                    <div class="form-group px-3">
                        <input type="hidden" id="profile_update_route" value="{{ route('user_profile_update') }}">

                        <label for="last_name" class="col-12 pl-0 pt-3 text-left">Nom</label>
                        <input type="text" id="last_name" class="col-md-12 form-control"
                            value="{{ $user['last_name'] }}">

                        <label for="first_name" class="col-12 pl-0 pt-3 text-left">Prénom</label>
                        <input type="text" id="first_name" class="col-md-12 form-control"
                            value="{{ $user['first_name'] }}">

                        <label for="phone" class="col-12 pt-3 pl-0 text-left">Téléphone</label>
                        <input type="text" id="phone" class="col-md-12 form-control" value="{{ $user['phone'] }}">

                        <label for="email" class="col-12 pt-3 pl-0 text-left">Email</label>
                        <input type="email" id="email" class="col-md-12 form-control" value="{{ $user['email'] }}">

                    </div>

                    <div class="form-group row mb-0 mr-4">
                        <div class="col-md-8 offset-md-4 text-right">
                            <button class="btn btn-primary" onclick="updateProfile()">
                                Enregistrer
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="border-bottom border-grey"></div>

        <div class="row justify-content-center pt-5">
            <div class="col-lg-4">
                <h3 class="mb-2 text-2xl font-bold">Mettre à jour le mot de passe</h3>
                <span class="text-justify" style="padding-top:-3px;">
                    Assurez-vous que votre compte utilise un long, aléatoire
                    mot de passe pour rester en sécurité.</span>
            </div>

            <div class="col-lg-8 pt-0 text-center">
                <div class="card mt-md-3 mb-5 rounded bg-white py-4" style="box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175)">
                    <label for="new_password" class="col-12 px-3 pl-0 text-left">Il vaut un au mois deux caractères spéciaux
                        dans votre mot de passe <br> comme <b>*,@.éè*</b> etc... truc dans ce genre</label><br>
                    <input type="hidden" id="password_update_route"
                        value="{{ route('user_pasword_update', $user['id']) }}">
                    <div class="form-group px-3">
                        <label for="new_password" class="col-12 pl-0 text-left">Nouveau mot de passe:</label>
                        <input type="password" id="new_password" class="col-md-12 form-control">
                    </div>

                    <div class="form-group px-3">
                        <label for="new_confirm_password" class="col-12 pl-0 text-left">Confirmez le mot de passe:</label>
                        <input type="password" id="new_confirm_password" class="col-md-12 form-control">
                    </div>

                    <div class="form-group row mb-0 mr-4">
                        <div class="col-md-8 offset-md-4 text-right">
                            <button class="btn btn-primary" onclick="updateUserPassword('{{ $user['id'] }}')">
                                Enregistrer
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

                <div class="row justify-content-center pt-5">
            <div class="col-lg-4">
                <h3 class="mb-2 text-2xl font-bold">Mettre à jour votre tuteur</h3>
                <span class="text-justify" style="padding-top:-3px;">
                    {{-- Votre tuteur est {{$user['first_name']}} --}}
                </span>
            </div>

            <div class="col-lg-8 pt-0 text-center">
                <div class="card mt-md-3 mb-5 rounded bg-white py-4" style="box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175)">
                    <label for="new_password" class="col-12 px-3 pl-0 text-left">dans la zone de texte entrez soit le CIP, du nouveau tuteur, soit son alias, soit son email</label><br>
                    <input type="hidden" id="guardian_update_route"
                        value="{{ route('user_guardian_update', $user['id']) }}">
                    <div class="form-group px-3">
                        <label for="guardian" class="col-12 pl-0 text-left">Nouveau tuteur:</label>
                        <input type="text" id="guardian" name="guardian" class="col-md-12 form-control">
                    </div>

                    <div class="form-group row mb-0 mr-4">
                        <div class="col-md-8 offset-md-4 text-right">
                            <button class="btn btn-primary" onclick="updateUserGuardian('{{ $user['id'] }}')">
                                Enregistrer
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="border-bottom border-grey"></div>

        <div class="row justify-content-center pt-5">
            <div class="col-lg-4">
                <h3 class="mb-2 text-2xl font-bold">Suppression de compte </h3>
                <span class="text-justify" style="padding-top:-3px;">Supprimer définitivement votre compte.</span>
            </div>

            <div class="col-lg-8 pt-0">
                <div class="card mt-md-3 mb-5 rounded bg-white py-4" style="box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175)">
                    <div class="px-3 text-left">
                        Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées.
                        Avant que
                        suppression de votre compte, veuillez télécharger les données ou informations que vous souhaitez
                        conserver.
                    </div>
                    <input type="hidden" id="user_deletion_route" value="{{ route('user_deletion') }}">

                    <div class="form-group row mb-0 mr-4 px-3 pt-4">
                        <div class="col-md-8 offset-l-4 text-left">
                            <button class="btn btn-danger pl-3" onclick="deleteUser('{{ $user['id'] }}')">
                                Supprimer le compte
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <script>
        /* User profile update */
        function updateProfile() {
            console.log($('#new_password').val());
            Swal.fire({
                title: "Veux-tu vraiment modifier ses informations ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Oui",
                cancelButtonText: "Annuler",
            }).then((result) => {
                console.log(result.isConfirmed);
                if (result.isConfirmed) {
                    let token = $('meta[name="csrf-token"]').attr('content');
                    const profile_update_route = $("#profile_update_route").attr('value');

                    $.ajax({
                        url: profile_update_route,
                        type: "PATCH",
                        data: {
                            first_name: $('#first_name').val(),
                            last_name: $('#last_name').val(),
                            phone: $('#phone').val(),
                            email: $('#email').val(),
                            _token: token,
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            Swal.fire({
                                html: '<b>INFORMATIONS EN COURS DE MISE A JOUR...</b>',
                                timer: 10000,
                                didOpen: () => {
                                    Swal.showLoading()
                                },
                                willClose: () => {
                                    clearInterval(10000)
                                }
                            })
                        },
                        success: function(response) {
                            console.log(response);
                            if (response) {
                                Swal.fire({
                                    icon: response[0],
                                    title: '<b>' + response[1] + '</b>',
                                    timer: 3000,
                                    timerProgressBar: true
                                })
                            }
                            location.reload(true);
                        },
                        error: function(error) {
                            console.log(error);
                            Swal.fire({
                                icon: response[0],
                                title: "Erreur veuillez réessayer",
                                timer: 3000,
                                timerProgressBar: true
                            })
                            location.reload(true);
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: "Action annulée",
                        timer: 3000,
                        timerProgressBar: true
                    })
                }
            });
        }

        /* User password update */
        function updateUserPassword() {
            console.log($('#new_confirm_password').val());
            Swal.fire({
                title: "Modifier le mot de passe ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#30B016",
                confirmButtonText: "Réinitialiser",
                cancelButtonColor: "#E13519",
                cancelButtonText: "Annuler",
            }).then((result) => {
                console.log(result.isConfirmed);
                if (result.isConfirmed) {
                    let token = $('meta[name="csrf-token"]').attr('content');
                    const password_update_route = $("#password_update_route").attr('value');

                    $.ajax({
                        url: password_update_route,
                        type: "PATCH",
                        data: {
                            password: $('#new_password').val(),
                            confirm_password: $('#new_confirm_password').val(),
                            _token: token,
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            Swal.fire({
                                html: '<b>MISE A JOUR DU MOT DE PASSE EN COURS...</b>',
                                timer: 10000,
                                didOpen: () => {
                                    Swal.showLoading()
                                },
                                willClose: () => {
                                    clearInterval(10000)
                                }
                            })
                        },
                        success: function(response) {
                            console.log(response);
                            if (response) {
                                Swal.fire({
                                    icon: response[0],
                                    title: '<b>' + response[1] + '</b>',
                                    timer: 20000,
                                    timerProgressBar: true
                                })
                            }
                        },
                        error: function(error) {
                            console.log(error);
                            Swal.fire({
                                icon: response[0],
                                title: "Erreur veuillez réessayer",
                                timer: 3000,
                                timerProgressBar: true
                            })
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: "Action annulée",
                        timer: 3000,
                        timerProgressBar: true
                    })
                }
            });
        }

                /* User guardian update */
        function updateUserGuardian() {
            console.log($('#new_confirm_password').val());
            Swal.fire({
                title: "Modifier le tuteur?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#30B016",
                confirmButtonText: "Réinitialiser",
                cancelButtonColor: "#E13519",
                cancelButtonText: "Annuler",
            }).then((result) => {
                console.log(result.isConfirmed);
                if (result.isConfirmed) {
                    let token = $('meta[name="csrf-token"]').attr('content');
                    const guardian_update_route = $("#guardian_update_route").attr('value');

                    $.ajax({
                        url: guardian_update_route,
                        type: "PUT",
                        data: {
                            guardian: $('#guardian').val(),
                            _token: token,
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            Swal.fire({
                                html: '<b>MISE A JOUR DU TUTEUR EN COURS...</b>',
                                timer: 10000,
                                didOpen: () => {
                                    Swal.showLoading()
                                },
                                willClose: () => {
                                    clearInterval(10000)
                                }
                            })
                        },
                        success: function(response) {
                            console.log(response);
                            if (response) {
                                Swal.fire({
                                    icon: response[0],
                                    title: '<b>' + response[1] + '</b>',
                                    timer: 20000,
                                    timerProgressBar: true
                                })
                            }
                        },
                        error: function(error) {
                            console.log(error);
                            Swal.fire({
                                icon: "error",
                                title: "Erreur veuillez réessayer",
                                timer: 3000,
                                timerProgressBar: true
                            })
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: "Action annulée",
                        timer: 3000,
                        timerProgressBar: true
                    })
                }
            });
        }

        /* User deletion */
        function deleteUser() {
            Swal.fire({
                title: "Suppression de compte",
                text: "Veux-tu vraiment supprimer ton compte?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#E13519",
                confirmButtonText: "Supprimer le compte",
                cancelButtonText: "Annuler",
            }).then((result) => {
                console.log(result.isConfirmed);
                if (result.isConfirmed) {

                    let token = $('meta[name="csrf-token"]').attr('content');
                    const user_deletion_route = $("#user_deletion_route").val();

                    $.ajax({
                        url: user_deletion_route,
                        type: "DELETE",
                        data: {
                            _token: token,
                        },
                        beforeSend: function() {
                            Swal.fire({
                                html: '<b>COMPTE EN COURS DE SUPPRESSION...</b>',
                                timer: 10000,
                                didOpen: () => {
                                    Swal.showLoading()
                                },
                                willClose: () => {
                                    clearInterval(10000)
                                }
                            })
                        },
                        success: function(response) {
                            console.log(response);
                            if (response) {
                                Swal.fire({
                                    icon: response[0],
                                    title: '<b>' + response[1] + '</b>',
                                    timer: 3000,
                                    timerProgressBar: true
                                })
                            }
                            location.reload(true);
                        },
                        error: function(error) {
                            console.log(error);
                            Swal.fire({
                                icon: response[0],
                                title: "Erreur veuillez réessayer",
                                timer: 3000,
                                timerProgressBar: true
                            })
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: "Action annulée",
                        timer: 3000,
                        timerProgressBar: true
                    })
                }
            });
        }
    </script>
@endsection
