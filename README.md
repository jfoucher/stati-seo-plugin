# Stati SEO Plugin

This is a very simple plugin that generates meta tags for each of your pages.

## Usage

The `{% seo %}` tag will generate any of the following if included in your site's _config.yml:

- `<title>` tag will be generated from your page title (in the page frontmatter) appended with your site title (as defined in _config.yml)
- Description will be generated from your page frontmatter `description` field or from your site's _config.yml `description` if the page description is unavailable
- Canonical urls will be generated for all pages 
- Twitter username, to be defined in your _config.yml as follows: 
  
  ```
      twitter:
        username: benbalter
  ```

- logo: URL to a site-wide logo (e.g., /images/company-logo.png).
- image: for pages that have the `image` field defined in their frontmatter, we'll use that for social images.
- google_site_verification for verifying ownership via Google webmaster tools
- lang - The locale these tags are marked up in. Of the format language_TERRITORY. Default is en_US.

We try to behave very similarly to the [jekyll-seo-tag](https://github.com/jekyll/jekyll-seo-tag) plugin does, but if something doesn't work right for you, please [open an issue](https://github.com/jfoucher/stati-seo-plugin/issues)