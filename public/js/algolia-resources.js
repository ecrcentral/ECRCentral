/* global instantsearch */

function hitTemplate(hit) {
  if (hit.published_at == ''){
    published = 'Check website';
  }else{
    published = hit.published_at;
  }

  var currentDate = new Date(hit.updated_at.replace(/-/g, "/"));
  var date = currentDate.getDate();
  var month = currentDate.getMonth(); 
  var year = currentDate.getFullYear();
  var dateString = date + "-" +(month + 1) + "-" + year;

  return `
    <div>
      <article>
        <div class="post-content">
          
          <h2 class="entry-title">
            <a href="/resources/${hit.slug}" rel="bookmark">
            ${hit._highlightResult.name.value}
            </a>
          </h2>
          <div class="post-excerpt">
            ${hit._highlightResult.source_name.value}
            </a>
          </div>
            <div class="entry-meta clear">
            ${get_logo(hit)}
            <div class="entry-funder-content">
              <div class="funder-name">
                <b>${hit.description}</b>
              </div>
              <div class="post-date">
                <i class="fa fa-book"></i> Category: ${hit.categories.toString()} <i class="fa fa-calendar"></i> Last updated: ${dateString}
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

function get_logo(hit){
  if(hit.logo != null)
    {
    return `<div class="funder-gravatar">
              <img src="/storage/${hit.logo}" height="40">
          </div>`;
    }else if (hit.source_name == 'Nature' || hit.source_name == 'Nature careers'){
    return `<div class="funder-gravatar">
              <img src="/images/nature-logo.jpg" height="40">
          </div>`;
  }else if(hit.source_name == 'Science' || hit.source_name == 'Science careers'){
    return `<div class="funder-gravatar">
              <img src="/images/science-logo.jpg" height="40">
          </div>`;
  }else if(hit.source_name == 'eLife'){
    return `<div class="funder-gravatar">
              <img src="/images/elife-logo.jpg" height="40">
          </div>`;
  }else if(hit.source_name == 'EMBO'){
    return `<div class="funder-gravatar">
              <img src="/images/embo-logo.jpg" height="40">
          </div>`;
  }else{
    return " ";
  }

}

const search = instantsearch({
  appId: "2YE81QTVE3",
  apiKey: "2a1b953e25371e863ca01b363db8a686",
  indexName: "resources_index",
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
      empty: "No resource found.",
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
    placeholder: "Search resources",
    autofocus: false
  })
);

// widget to add search stats.

 search.addWidget(
  instantsearch.widgets.stats({
    container: "#stats",
    templates: {
      body(hit) {
        return `<i class="fab fa-searchengin"></i> <strong>${hit.nbHits}</strong> resources found ${
          hit.query != "" ? `for <strong>"${hit.query}"</strong>` : ``
        }</strong>`;
      }
    }
  })
);

// widget to add Funders list.

 search.addWidget(
  instantsearch.widgets.refinementList({
    container: "#categories",
    attributeName: "categories",
    autoHideContainer: false,
    showMore: true,
    searchForFacetValues: false,
    collapsible: true,
    limit: 15,
    templates: {
      header: "Resource category"
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
