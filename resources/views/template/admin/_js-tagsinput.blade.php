<script type="text/javascript" src="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/typeahead/typeahead.js') }}"></script>
<script type="text/javascript">
    // Generate tagsinput
    function generate_tagsinput(selector){
        $(selector).tagsinput({
            typeaheadjs: {
                source: substringMatcher({!! json_encode(array_tag()) !!})
            }
        });
    }

    var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            // an array that will be populated with substring matches
            matches = [];

            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });

            cb(matches);
        };
    };
</script>