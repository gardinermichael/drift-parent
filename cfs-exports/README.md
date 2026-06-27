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

### Adding the `subsection_heading` field

The About field group already exists on any site running this template, and
CFS's **Tools → Import** does *not* merge into an existing group — it skips
groups whose slug (`post_name`, here `about`) is already present. So importing
this file on a live/staging site will **not** add the new field. Use the manual
path below for existing sites; entered data is unaffected either way.

**Existing site (manual — recommended):**

1. WordPress admin → **Field Groups** → edit **About**.
2. Inside the **Content** (`submit_content`) loop, add a new **Text** field:
   - **Name:** `subsection_heading` (must match exactly)
   - **Label:** `Subsection heading (e.g. Editorial / Business)`
   - Drag it above the **Title** (`about_title`) field.
3. **Save**. The field config in `about-page.json` is the reference for these
   values.

**Fresh site (no About group yet):** **Tools → Import** this file to create the
whole group, including `subsection_heading`.

> Avoid deleting the existing group to re-import — that can drop other manual
> edits to the group. Add the single field manually instead.
