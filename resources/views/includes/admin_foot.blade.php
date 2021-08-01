<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="{{asset('assets/admin/js/app.js')}}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.25/dataRender/datetime.js"></script>

<script>
  const formatRupiah = (money) => {
    return new Intl.NumberFormat('id-ID',
      {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
      }
    ).format(money);
  }
  //add a function to jQuery so we can call it on our jQuery collections
  $.fn.capitalize = function () {
    //iterate through each of the elements passed in, `$.each()` is faster than `.each()
    $.each(this, function () {
      //split the value of this input by the spaces
      var split = this.value.split(' ');

      //iterate through each of the "words" and capitalize them
      for (var i = 0, len = split.length; i < len; i++) {
        split[i] = split[i].charAt(0).toUpperCase() + split[i].slice(1);
      }

      //re-join the string and set the value of the element
      this.value = split.join(' ');
    });
    return this;
  };

  function string_to_slug (str) {
    str = str.replace(/^\s+|\s+$/g, '');
    str = str.toLowerCase();
    var from = "àáãäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to   = "aaaaaeeeeiiiioooouuuunc------";
    for (var i=0, l=from.length ; i<l ; i++) {
      str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }
    str = str.replace(/[^a-z0-9 -]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
    return str;
  }

</script>
@yield('content_js')
@include('sweetalert::alert')
