@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Mi cuenta"; //set dynamic page title
?>
@extends($layout)

@section('title', $pageTitle)

@section('content')
<section class="page" data-page-type="view" data-page-url="{{ url()->full() }}">
    <div  class="" >
        <div class="container">
            <div class="row ">
                <div class="col comp-grid " >
                    <div  class=" page-content" >
                        <?php
                            if($data){
                            $rec_id = ($data['user_id'] ? urlencode($data['user_id']) : null);
                        ?>
                        <div class="bg-primary m-2 mb-4">
                            <div class="profile">
                                <div class="avatar">
                                    <span class="avatar-icon text-white"><i class="material-icons">account_box</i></span>
                                </div>
                                <h1 class="title mt-4"><?php echo $data['username']; ?></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mx-3 mb-3">
                                    <ul class="nav nav-pills flex-column text-left">
                                        <li class="nav-item">
                                            <a data-bs-toggle="tab" href="#AccountPageView" class="nav-link active">
                                                <i class="material-icons">account_box</i> Detalle de cuenta
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a data-bs-toggle="tab" href="#AccountPageEdit" class="nav-link">
                                                <i class="material-icons">edit</i> Editar cuenta
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-sm-9">
                                <div class="mb-3">
                                    <div class="tab-content">
                                        <div class="tab-pane show active fade" id="AccountPageView" role="tabpanel">
                                            <div class="page-data">
                                                <!--PageComponentStart-->
                                                <div class="mb-3 row row justify-content-start g-0">
                                                    <div class="col-12">
                                                        <div class="bg-light mb-1 card-1 p-2 border rounded">
                                                            <div class="row align-items-center">
                                                                <div class="col">
                                                                    <small class="text-muted">ID</small>
                                                                    <div class="fw-bold">
                                                                        <?php echo  $data['user_id'] ; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="bg-light mb-1 card-1 p-2 border rounded">
                                                            <div class="row align-items-center">
                                                                <div class="col">
                                                                    <small class="text-muted">Nombre de usuario</small>
                                                                    <div class="fw-bold">
                                                                        <?php echo  $data['username'] ; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--PageComponentEnd-->
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="AccountPageEdit" role="tabpanel">
                                            <div class=" reset-grids">
                                                <x-sub-page url="{{ url('account/edit') }}"></x-sub-page>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            }
                            else{
                        ?>
                        <!-- Empty Record Message -->
                        <div class="text-muted p-3">
                            <i class="material-icons">block</i> ningún record fue encontrado
                        </div>
                        <?php
                            }
                        ?>
                    </div>

                </div>

            </div>
        </div>
    </div>

</section>
<!-- Page custom js --><script><!--pageautofill--><!--custom page js--><!--pagejs--></script>
<!-- Page custom css --><style><!--custom page css--><!--pagecss--></style>
@endsection
