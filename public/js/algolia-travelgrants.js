/* global instantsearch */

function hitTemplate(hit) {
  if (hit.deadline == ''){
    deadline = 'Check website';
  }else{
    deadline = hit.deadline;
  }

  var currentDate = new Date(hit.updated_at);
  var date = currentDate.getDate();
  var month = currentDate.getMonth(); 
  var year = currentDate.getFullYear();
  var dateString = date + "-" +(month + 1) + "-" + year;

  return `
    <div>
      <article>
        <div class="post-content">
          
          <h2 class="entry-title">
            <a href="/travel-grants/${hit.slug}" rel="bookmark">
            ${hit._highlightResult.name.value}
            </a>
          </h2>
          <div class="post-excerpt">
            ${hit._highlightResult.funder_name.value}
            </a>
          </div>
            <div class="entry-meta clear">
            ${get_logo(hit.funder_name)}
            <div class="entry-funder-content">
              <div class="funder-name">
                <i class="fas fa-user-graduate"></i> Applicant nationality: ${hit.applicant_country} | 
<i class="fas fa-university"></i> Grant purpose: ${hit.purpose}
              </div>
              <div class="post-date">
                <i class="far fa-calendar-alt"></i> Deadline: ${deadline} | Last updated: ${dateString}
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

function get_logo(funder_name){
  if (funder_name == 'The Royal Society'){
    return `<div class="funder-gravatar">
              <img src="https://royalsociety.org/~/media/Redesign2015/rs-crest-footer.png" width="40" height="40">
          </div>`;
  }else if(funder_name == 'National Institutes of Health'){
    return `<div class="funder-gravatar">
              <img src="https://www.nih.gov/sites/default/files/about-nih/2012-logo.png" width="40" height="40">
          </div>`;
  }else if(funder_name == 'eLife'){
    return `<div class="funder-gravatar">
              <img src="https://pbs.twimg.com/profile_images/794233223551315969/uLsKoQxk_400x400.jpg" width="40" height="40">
          </div>`;
  }else if(funder_name == 'EMBO'){
    return `<div class="funder-gravatar">
              <img src="https://www.wemakescholars.com/admin/uploads/providers/1521.jpg" width="40" height="40">
          </div>`;
  }else{
    return " ";
  }

}



const search = instantsearch({
  appId: "2YE81QTVE3",
  apiKey: "2a1b953e25371e863ca01b363db8a686",
  indexName: "travel_grants_index",
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
      empty: "No travel grants found.",
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
    placeholder: "Search travel grants",
    autofocus: false
  })
);

// widget to add search stats.

 search.addWidget(
  instantsearch.widgets.stats({
    container: "#stats",
    templates: {
      body(hit) {
        return `<i class="fab fa-searchengin"></i> <strong>${hit.nbHits}</strong> travel grants found ${
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
    attributeName: "funder_name",
    autoHideContainer: false,
    showMore: true,
    searchForFacetValues: false,
    collapsible: true,
    limit: 10,
    templates: {
      header: "Funders"
    }
  }
  )
);

// widget to add grant purpose list.

search.addWidget(
  instantsearch.widgets.refinementList({
    container: "#applicant_countries",
    attributeName: "purpose",
    autoHideContainer: true,
    showMore: true,
    searchForFacetValues: false,
    collapsible: true,
    limit: 10,
    templates: {
      header: "Grant purpose"
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
