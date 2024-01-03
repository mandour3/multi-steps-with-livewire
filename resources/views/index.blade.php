<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>multi-step form </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <style>
        .form-section{
            display: none;
        }
        .form-section.current{
            display: inline;
        }
        .parsley-errors-list{
            color: red;
        }
    </style>

</head>
<body>

    <div class="container-fluid">
        @if (session('message'))
            <div class="alert alert-success text-center" role="alert">{{ session('message') }}</div>
        @endif
        <div class="row justify-content-md-center">
            <div class="col-md-9">
                <div class="card px-5 py-3 mt-5 shadow">
                    <h1 class="text-success text-center mt-3 mb-4">multi-step form</h1>

                    <div class="nav nav-fill my-3">
                        <label class="nav-link shadow-sm step0  border ">fill your data</label>
                        <label class="nav-link shadow-sm step1  border ">check legacy</label>
                        <label class="nav-link shadow-sm step2  border ">completion</label>
                    </div>
                        <form action="{{ route('save') }}" method="post" class="worker-form" >
@csrf
                            <div class="form-section">
                                <label for="1">first name</label>
                                <input id="1" type="text" class="form-control mb-3" name="first_name">
                                <label for="2">last name</label>
                                <input id="2" type="text" class="form-control mb-3" name="last_name">
                            </div>
                            <div class="form-section">
                                <label for="3">Email</label>
                                <input id="3" type="text" class="form-control mb-3" name="email">
                                <label for="4">phone</label>
                                <input id="4" type="text" class="form-control mb-3" name="phone">
                            </div>

                            <div class="form-section">
                                <label for="5">Address</label>
                                <textarea name="address" class="form-control mb-3" cols="50" rows="4" placeholder="Your Address here"></textarea>

                            </div>
                            <div class="form-navigation mt-3">
                                <button type="button" class="previous btn btn-primary " style="float: left">previous</button>
                                <button type="button" class="next btn btn-primary" style="float: right">next</button>
                                <button type="submit" class=" btn btn-success "style="float: right">submit</button>


                            </div>
                        </form>




                </div>
            </div>


        </div>
    </div>
    <script>

        $(function(){
            var $sections=$('.form-section');

            function navigateTo(index){

                $sections.removeClass('current').eq(index).addClass('current');

                $('.form-navigation .previous').toggle(index>0);
                var atTheEnd = index >= $sections.length - 1;
                $('.form-navigation .next').toggle(!atTheEnd);
                $('.form-navigation [Type=submit]').toggle(atTheEnd);


                const step= document.querySelector('.step'+index);
                step.style.backgroundColor="#17a2b8";
                step.style.color="white";



            }

            function curIndex(){

                return $sections.index($sections.filter('.current'));
            }

            $('.form-navigation .previous').click(function(){
                navigateTo(curIndex() - 1);
            });

            $('.form-navigation .next').click(function(){
                $('.worker-form').parsley().whenValidate({
                    group:'block-'+curIndex()
                }).done(function(){
                    navigateTo(curIndex()+1);
                });

            });

            $sections.each(function(index,section){
                $(section).find(':input').attr('data-parsley-group','block-'+index);
            });


            navigateTo(0);



        });


    </script>


</body>
</html>
