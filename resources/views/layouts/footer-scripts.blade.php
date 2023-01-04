<!-- jquery -->
<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script type="text/javascript">
    var plugin_path='{{asset('assets/js')}}/';
</script>

<!-- chart -->
<script src="{{ URL::asset('assets/js/chart-init.js') }}"></>
<!-- calendar -->
<script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->

// <script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>


<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>

<!-- select2-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js" integrity="sha512-XBxUMC4YQcL60PavAScyma2iviXkiWNS5Yf+A0LZRWI1PNiGHkp66yPQxHWDSlv6ksonLAL2QMrUlCKq4NHhSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@yield('js')
@livewireScripts


<script>
    //check all process
    function check_all(eleclass,element){
    var elements = document.getElementsByClassName(eleclass);
    var elength = elements.length;
    var deleteAllBtn = document.getElementById("btn_delete_all");
    console.log(deleteAllBtn);
    if(element.checked){
        // deleteAllBtn.disabled = false;
        for (var i=0 ; i<elength ; i++){
            elements[i].checked = true;
        }
    } else {
        // deleteAllBtn.disabled = true
        for (var i=0 ; i<elength ; i++){
            elements[i].checked = false;
        }
    }
}

//select 2 plugin
$('.filter_levels').select2({

//   "id": "value attribute" || "option text",
//   "text": "label attribute" || "option text",
//   "element": HTMLOptionElement

});





</script>
    <script>
    //add levels by selecting grade
    $(document).ready(function () {
        $('select[name="grade_id"]').on('change', function () {
            var grade_id = $(this).val();
            if (grade_id) {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to("getLevelsByGrade") }}/" + grade_id,
                    type: "GET",
                    dataType:"json",
                    success: function (data) {
                        $('select[name="level_id"]').empty();
                         $('select[name="level_id"]').append('<option value="selected disabled">{{trans('students_trans.choose')}}</option>');
                        $.each(data, function (key, value) {

                            $('select[name="level_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },

                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
    //add sections by selecting level
    $(document).ready(function () {
        $('select[name="level_id"]').on('change', function () {
            var level_id = $(this).val();
            console.log(level_id);
            if (level_id) {
                    $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ URL::to("getSectionsByLevel") }}/" + level_id,
                    type: "GET",
                    dataType:"json",
                    success: function (data) {
                        console.log( "type", typeof(data));
                        $('select[name="section_id"]').empty();
                         $('select[name="section_id"]').append('<option value="selected disabled">{{trans('students_trans.choose')}}</option>');
                        $.each(data, function (key, value) {
                            $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },

                });

            } else {
                console.log('AJAX load did not work');
            }
        });
    });
    </script>

    @if(Auth::guard('teacher')->check())
    <script>
        //add levels by selecting grade
        $(document).ready(function () {
            $('select[name="grade_id"]').on('change', function () {
                var grade_id = $(this).val();
                if (grade_id) {
                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ URL::to("/teacher/dashboard/getLevelsByGrade") }}/" + grade_id,
                        type: "GET",
                        dataType:"json",
                        success: function (data) {
                            $('select[name="level_id"]').empty();
                             $('select[name="level_id"]').append('<option value="selected disabled">{{trans('students_trans.choose')}}</option>');
                            $.each(data, function (key, value) {

                                $('select[name="level_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },

                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
        //add sections by selecting level
        $(document).ready(function () {
            $('select[name="level_id"]').on('change', function () {
                var level_id = $(this).val();
                console.log(level_id);
                if (level_id) {
                        $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ URL::to("getSectionsByLevel") }}/" + level_id,
                        type: "GET",
                        dataType:"json",
                        success: function (data) {
                            console.log( "type", typeof(data));
                            $('select[name="section_id"]').empty();
                             $('select[name="section_id"]').append('<option value="selected disabled">{{trans('students_trans.choose')}}</option>');
                            $.each(data, function (key, value) {
                                $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },

                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
        </script>
    @endif










