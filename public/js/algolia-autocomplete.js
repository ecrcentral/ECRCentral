var client = algoliasearch("2YE81QTVE3", "2a1b953e25371e863ca01b363db8a686")
var fundings = client.initIndex('fundings_index');
var travel_grants = client.initIndex('travel_grants_index');

autocomplete('#aa-search-input', {}, [
    {
      source: autocomplete.sources.hits(fundings, { hitsPerPage: 6 }),
      displayKey: 'name',
      templates: {
        header: '<div class="aa-suggestions-category">Funding schemes and fellowships</div>',
        suggestion: function(suggestion) {
          return '<span><a href="/fundings/'+suggestion.slug+'">'+suggestion._highlightResult.name.value+'</a></span><span>'
              + suggestion._highlightResult.funder_name.value + '</span>';
        }
      }
    },
    {
      source: autocomplete.sources.hits(travel_grants, { hitsPerPage: 3 }),
      displayKey: 'name',
      templates: {
        header: '<div class="aa-suggestions-category">Travel Grants for conferences collaborations</div>',
        suggestion: function(suggestion) {
          return '<span><a href="/travel-grants/'+suggestion.slug+'">'+suggestion._highlightResult.name.value + '</a></span><span>'
              + suggestion._highlightResult.funder_name.value + '</span>';
        }
      }
    }
]);

