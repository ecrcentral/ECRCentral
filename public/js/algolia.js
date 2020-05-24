/* global instantsearch */

function hitTemplate(hit) {
  if (hit.deadline == ''){
    deadline = 'Check website';
  }else{
    deadline = hit.deadline;
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
            <a href="/fundings/${hit.slug}" rel="bookmark">
            ${hit._highlightResult.name.value}
            </a>
          </h2>
          <div class="post-excerpt">
            ${hit._highlightResult.funder_name.value}
            </a>
          </div>
            <div class="entry-meta clear">
            ${get_logo(hit.logos)}
            <div class="entry-funder-content">
              <div class="funder-name">
                <i class="fa fa-globe"></i> Applicant nationality: ${hit.applicant_country} | 
<i class="fa fa-university"></i> Host country: ${hit.host_country}
              </div>
              <div class="post-date">
                <i class="fa fa-calendar"></i> Application deadline: ${deadline} | Last updated: ${dateString}
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

function get_logo(logos){
  if (logos != null){
    if(logos.length == 1)
    {
    return `<div class="funder-gravatar">
              <img src="/storage/${logos}" height="40">
          </div>`;
    }else{
        logos_html = '<div class="funder-gravatar">'
        for(var logo in logos)
        {
          logos_html = logos_html.concat(`<img src="/storage/${logo}" height="40">`)
        }
        return logos_html.concat('</div>');
    }
  }else{
    return " ";
  }

}

function get_logo2(funder_name){
  if (funder_name == 'American Psychological Foundation'){
    return `<div class="funder-gravatar">
              <img src="https://www.insidehighered.com/sites/default/server_files/styles/large/public/media/APA.png" width="40" height="40">
          </div>`;
  }else if(funder_name == 'National Institutes of Health'){
    return `<div class="funder-gravatar">
              <img src="https://www.nih.gov/sites/default/files/about-nih/2012-logo.png" width="40" height="40">
          </div>`;
  }else if(funder_name == 'American Gastroenterological Association'){
    return `<div class="funder-gravatar">
              <img src="https://www.southbaygastro.com/wp-content/uploads/2017/11/logo_aga-1.png" width="40" height="40">
          </div>`;
  }else if(funder_name == 'Human Frontiers in Science Program'){
    return `<div class="funder-gravatar">
              <img src="http://www.hfsp.org/sites/www.hfsp.org/files/webfm/Communications/logo-blue-6x6.jpg" width="40" height="40">
          </div>`;
  }else{
    return " ";
  }

}

function hitTemplate22(hit) {
  return `<tr>
<td><strong><a href="/fundings/${hit.id}">${hit.name}</a></strong><br>${hit.funder_name}</td>
<td class="hidden-xs pull-right" align="right"> | <small><i class="fas fa-user-graduate"></i> Applicant: ${hit.applicant_country} | 
<i class="fas fa-university"></i> Host: ${hit.host_country}</small></td>
</tr>`;
}

const search = instantsearch({
  appId: "2YE81QTVE3",
  apiKey: "2a1b953e25371e863ca01b363db8a686",
  indexName: "fundings_index",
  searchParameters: {
    hitsPerPage: 15,
    attributesToSnippet: ["content:14"],
    snippetEllipsisText: " [...]"
  }
});

// Uncomment the following widget to add hits list.

 search.addWidget(
  instantsearch.widgets.hits({
    container: "#hits",
    templates: {
      empty: "No fundings schemes/fellowships found.",
      item(hit) {
        return hitTemplate(hit);
      }
    }
  })
);

/*
search.addWidget(
  instantsearch.widgets.currentRefinements({
  container: '#current-refinements',
  includedAttributes: ['funder_name'],
})
);
*/


// Uncomment the following widget to add a search bar.

 search.addWidget(
  instantsearch.widgets.searchBox({
    container: "#searchbox",
    placeholder: "Search funding schemes and fellowships",
    autofocus: false
  })
);

// Uncomment the following widget to add search stats.

 search.addWidget(
  instantsearch.widgets.stats({
    container: "#stats",
    templates: {
      body(hit) {
        return `<i class="fab fa-searchengin"></i> <strong>${hit.nbHits}</strong> funding opportunities found ${
          hit.query != "" ? `for <strong>"${hit.query}"</strong>` : ``
        }</strong>`;
      }
    }
  })
);

// Uncomment the following widget to add categories list.

 search.addWidget(
  instantsearch.widgets.refinementList({
    container: "#categories",
    attributeName: "funders",
    autoHideContainer: false,
    showMore: true,
    searchForFacetValues: false,
    collapsible: true,
    limit: 5,
    templates: {
      header: "Funders",
    }
  }
  )
);

 search.addWidget(
  instantsearch.widgets.refinementList({
    container: "#subjects",
    attributeName: "subjects",
    autoHideContainer: false,
    showMore: true,
    searchForFacetValues: false,
    collapsible: true,
    limit: 5,
    templates: {
      header: "Subjects",
    }
  }
  )
);

search.addWidget(
  instantsearch.widgets.refinementList({
    container: "#host_countries",
    attributeName: "host_country",
    autoHideContainer: false,
    showMore: true,
    limit: 5,
    templates: {
      header: "Host country"
    }
  }

  )
);

search.addWidget(
  instantsearch.widgets.refinementList({
    container: "#applicant_countries",
    attributeName: "applicant_country",
    autoHideContainer: true,
    showMore: true,
    limit: 5,
    templates: {
      header: "Applicant country"
    }
  }

  )
);

 search.addWidget(
  instantsearch.widgets.refinementList({
    container: "#career_levels",
    attributeName: "career_levels",
    autoHideContainer: false,
    showMore: true,
    searchForFacetValues: false,
    collapsible: true,
    limit: 5,
    templates: {
      header: "Academic requirement",
    }
  }
  )
);


 search.addWidget(
  instantsearch.widgets.refinementList({
    container: "#call_frequency",
    attributeName: "frequency",
    autoHideContainer: false,
    showMore: true,
    searchForFacetValues: false,
    collapsible: true,
    limit: 5,
    templates: {
      header: "Call frequency",
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
