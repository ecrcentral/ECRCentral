export function hitTemplate22(hit) {
  return `
    <div>
      <article>
        <div class="post-img">
          <a href="${hit.slug}">
          <img src="${hit.image}">
          </a>
        </div>
        <div class="post-content">
          <div class="post-date">
            ${hit.post_date_formatted}
          </div>
          <h2 class="entry-title">
            <a href="${hit.permalink}" rel="bookmark">
            ${hit._highlightResult.post_title.value}
            </a>
          </h2>
          <div class="post-excerpt">
            ${hit._snippetResult.content.value}
          </div>
          <div class="entry-meta clear">
            <div class="author-gravatar">
              <img src="${hit.author_image_url}" width="40" height="40">
            </div>
            <div class="entry-author-content">
              <div class="author-name">
                ${hit._highlightResult.author_name.value}
              </div>
              <div class="post-meta-info">
                ${
                  hit.time_to_read
                } min read in ${hit._highlightResult.categories
    .map(x => x.value)
    .join(", ")}
              </div>
            </div>
          </div>
        </div>
      </article>
    </div>`;
}


export function hitTemplate(hit) {
  return `
    <div>
      <article>
        <div class="post-img">
          <a href="${hit.slug}">
          ${hit.name}
          </a>
        </div>
        <div class="post-content">
          <div class="post-date">
            ${hit.funder_name}
          </div>
        </div>
      </article>
    </div>`;
}

