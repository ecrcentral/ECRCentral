/* global instantsearch */


function hitTemplate(hit) {

  return `
    <div>
      <article>
        <div class="post-content">
          
          <h2 class="entry-title">
            <a href="/funders/${hit.slug}" rel="bookmark">
            ${hit._highlightResult.name.value}
            </a>
          </h2>
          <div class="post-excerpt">
            ${hit._highlightResult.country.value}
            </a>
          </div>
            <div class="entry-meta clear">
            ${get_logo(hit.logo)}
            <div class="entry-funder-content">
              <div class="funder-name">
                <strong>
                 ${get_url(hit)}
                 ${is_dora(hit.dora)}
                </strong>
              </div>
              <!--
              <div class="post-meta-info">
              </div>
              -->
            </div>
          </div>
        </div>
      </article>
    </div>`;
}

function get_url(hit){
  if (hit.funder_id == hit.slug){
   
   if(hit.url != null)
   {
      return `<i class="fa fa-external-link"></i>
<a href="${hit.url}" target="_blank">${hit.url}</a>`;
        }
   }else
   {
    return `<i class="ai ai-doi"></i>
    <a href="http://dx.doi.org/10.13039/${hit.funder_id}" target="_blank">http://dx.doi.org/10.13039/${hit.funder_id}</a>`;
   }

}

function is_dora(dora){
  if(dora == 'Yes'){
  return `<br><img src="/images/dora.png" height="13px"> DORA signatory`;
}else{
  return " ";
}
}

function get_logo(logo){
  if (logo != null){
   
      return `<div class="funder-gravatar">
              <img src="/storage/${logo}" height="40">
          </div>`;
    
  }else{
    return " ";
  }

}



const search = instantsearch({
  appId: "2YE81QTVE3",
  apiKey: "2a1b953e25371e863ca01b363db8a686",
  indexName: "funders_index",
  searchParameters: {
    hitsPerPage: 10,
    attributesToSnippet: ["content:14"],
    snippetEllipsisText: " [...]"
  }
});

// widget to add hits list.

 search.addWidget(
  instantsearch.widgets.hits({
    container: "#hits",
    templates: {
      empty: "No funder found.",
      item(hit) {
        return hitTemplate(hit);
      }
    }
  })
);

// widget to add a search bar.

 search.addWidget(
  instantsearch.widgets.searchBox({
    container: "#searchbox",
    placeholder: "Search funders",
    autofocus: false
  })
);

// widget to add search stats.

 search.addWidget(
  instantsearch.widgets.stats({
    container: "#stats",
    templates: {
      body(hit) {
        return `<i class="fab fa-searchengin"></i> <strong>${hit.nbHits}</strong> funders found ${
          hit.query != "" ? `for <strong>"${hit.query}"</strong>` : ``
        }</strong>`;
      }
    }
  })
);

// widget to add Funders list.

 search.addWidget(
  instantsearch.widgets.refinementList({
    container: "#countries",
    attributeName: "country",
    autoHideContainer: false,
    showMore: true,
    searchForFacetValues: false,
    collapsible: true,
    limit: 10,
    templates: {
      header: "Funder Country"
    }
  }
  )
);

// widget to add Funders list.

 search.addWidget(
  instantsearch.widgets.refinementList({
    container: "#dora",
    attributeName: "dora",
    autoHideContainer: false,
    showMore: true,
    searchForFacetValues: false,
    collapsible: true,
    limit: 2,
    templates: {
      header: "Is DORA signatory?"
    }
  }
  )
);


// Uncomment the following widget to add pagination.

search.addWidget(
  instantsearch.widgets.pagination({
    container: "#pagination"
  })
);

search.start();
