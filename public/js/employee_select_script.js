$(function() {
    $('#company_id').select2({
        placeholder: 'Open this select menu',
        minimumInputLength: 1,
        ajax: {
            url: select_url,
            dataType: 'json',
            delay: 250,
            processResults: function (data, params) {
                let res_data = $.map(data.data, function (obj) {
                    obj.text = obj.name; // replace name with the property used for the text

                    return obj;
                });

                params.page = params.page || 1;

                return {
                    results: res_data,
                    pagination: {
                        more: (params.page * 30) < data.total
                    }
                };
            },
            cache: true,
        },
    });
});
