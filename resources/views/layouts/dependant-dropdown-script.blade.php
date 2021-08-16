<script>

    const baseOptionAppend = function (context) {
        return "<option value disabled selected>{{ trans('global.pleaseSelect') }}</option>"
    }
    const baseUrlFetch = "{{ url('/admin/sisters/handle') }}"
    const provinceDropdown = $('#province')
    const cityDropdown = $('#city');
    const kecamatanDropdown = $('#sub_district')
    const kelurahanDropdown = $('#ward')

    const clearProvince = function () {
        provinceDropdown.empty()
        provinceDropdown.append(baseOptionAppend)
    }

    const clearCity = function () {
        cityDropdown.empty()
        cityDropdown.append(baseOptionAppend)
    }

    const clearKecamatan = function () {
        kecamatanDropdown.empty()
        kecamatanDropdown.append(baseOptionAppend)
    }

    const clearKelurahan = function () {
        kelurahanDropdown.empty()
        kelurahanDropdown.append(baseOptionAppend)
    }
    
    let handleProvince = function (event) {
        let provinceId = $(this).val();
        // Make a calls
        $.ajax({
            url: baseUrlFetch + "/city/" + provinceId,
            type: "GET",
            dataType: "json",
            success:function(data) {
                clearCity()
                clearKecamatan()
                clearKelurahan()
                $.each(data, function(key, value) {
                    cityDropdown.append('<option value="'+ value.id +'">'+ value.nama +'</option>');
                    }
                );
            }
        });
    };

    let handleCity = function (event) {
        let cityId = $(this).val();
        // Make a calls
        $.ajax({
            url: baseUrlFetch + "/sub-district/" + cityId,
            type: "GET",
            dataType: "json",
            success:function(data) {
                clearKecamatan()
                clearKelurahan()
                $.each(data, function(key, value) {
                    kecamatanDropdown.append('<option value="'+ value.id +'">'+ value.nama +'</option>');
                    }
                );
            }
        });
    };

    let handleKecamatan = function (event) {
        let kecamatanId = $(this).val();
        // Make a calls
        $.ajax({
            url: baseUrlFetch + "/ward/" + kecamatanId,
            type: "GET",
            dataType: "json",
            success:function(data) {
                clearKelurahan()
                $.each(data, function(key, value) {
                    kelurahanDropdown.append('<option value="'+ value.id +'">'+ value.nama +'</option>');
                    }
                );
            }
        });
    };

    // Listeners
    provinceDropdown.change( handleProvince )
    cityDropdown.change( handleCity )
    kecamatanDropdown.change( handleKecamatan )

</script>