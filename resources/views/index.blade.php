@extends('layouts.app')

@section('content')
    <div class="container d-flex h-100">
        <div class="row justify-content-center align-self-center w-100 mx-auto">
            <div class="col-12">
                <div class="card">
                    <div class="card-header lead">Search train lines</div>
                    <div class="card-body">
                        <form id="search-train-lines-form">
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="from">From</label>
                                    <select id="from" name="from" class="form-control">
                                        <option value="0">Choose...</option>
                                        @if (count($places) > 0)
                                            @foreach ($places as $place)
                                                <option value="{{ $place->id }}">{{ $place->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="to">To</label>
                                    <select id="to" name="to" class="form-control">
                                        <option value="0">Choose...</option>
                                        @if (count($places) > 0)
                                            @foreach ($places as $place)
                                                <option value="{{ $place->id }}">{{ $place->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-block btn-success">Search</button>
                                </div>
                            </div>
                        </form>
                        <div id="dynamic_content"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $(document).ready(function(){
                $('#search-train-lines-form button[type="button"]').click(function(event){
                    event.preventDefault();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    let from = $("select[name=from]").val();
                    let to = $("select[name=to]").val();

                    $.ajax({
                        url: "/ajax-search-train-lines",
                        type:"POST",
                        data:{
                            from:from,
                            to:to
                        },
                        success:function(response){
                            console.log(response);
                            $('#dynamic_content').empty().html(response);
                        },
                    });
                });
            });          
        });
    </script>
@endsection