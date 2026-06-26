# CFS field exports

Version-controlled exports of the [Custom Field Suite](https://wordpress.org/plugins/custom-field-suite/)
field groups used by this theme. CFS stores its field definitions in the
database, so these JSON files are the source of truth for that configuration
in code review.

## about-page.json

Field group for the About / masthead page (template `page-templates/about-page.php`).

Structure:

```
about_content_section (loop)        ← a masthead section, repeatable
├─ heading_line                     ← section heading
├─ about_subtitle                   ← section subtitle
└─ submit_content (loop)            ← entries, repeatable
   ├─ subsection_heading            ← optional: see below
   ├─ about_title                   ← entry title (e.g. role)
   └─ about_text                    ← entry text (e.g. name)
```

`subsection_heading` is optional. When an entry has it filled in, the template
renders a dividing line and the label above that entry, demarking a new
subsection (for example, splitting **Editorial** from **Business** within a
single masthead section). Leave it blank on entries that continue the current
subsection.

### Importing

In WordPress admin: **Field Groups → Tools → Import**, then upload this file
(or paste its contents). This adds the `subsection_heading` field without
affecting existing entries.
