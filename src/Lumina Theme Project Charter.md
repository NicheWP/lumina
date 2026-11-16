# Lumina Theme Project Charter v1.0.0 Alpha 
# Section 1: Project Vision & Features

## 1.1 Project Vision: Modern Full-Site Editing

Lumina represents a modern evolution of WordPress Full-Site Editing (FSE). Inspired by the colors, ambient light, and natural depth of the physical environment around us, Lumina bridges organic aesthetics with high-performance digital web architecture. 

We believe website layouts should feel balanced, tactile, and natural—bringing the structural rhythms and light behavior of the physical world directly onto the digital canvas. 

The Lumina theme demo is a showcase for a high-end photography or web design studio. It shows how the default theme color palette is intended to be used with mostly neutral or subtle colors with bold page heroes and call-to-action sections. It demonstrates restrained use of glass over cover images. It features interactive cards and pan-zoom motion images which are flagship features of the theme.  

See the [technical documentation overview](https://nichewp.github.io/lumina/) for implementation details.

## 1.2 Dynamic Moods via Global Styles

While Lumina provides numerous color palettes and curated fonts, it's Global Style variations let site creators choose a cohesive visual mood and adapt it in the Site Editor. Each **Lumina Mood** expresses a distinct approach to form, spacing, and interaction:

* **Lumina Gallery:** Designed for high-end exhibition spaces and editorial layouts. Features slightly rounded architectural corners, generous spacing, and luxurious, deliberate motion that gives interactive elements a weighted, physical presence.
* **Lumina Tactical:** Tailored for utility, speed, and dense information architecture. Uses compact spacing and crisp, quick-response motion for a focused, efficient feel.
* **Lumina Spacious:** An ultra-modern, fluid mood. Pairs soft, pebble-like forms and expansive spacing with playful, elastic motion.
* **Lumina Minimal:** A refined, reduced-motion mood for a quieter, typographic focus. Interactive elements avoid pronounced scaling or shifting while retaining subtle feedback.

See the [theme variables and style reference](https://nichewp.github.io/lumina/variables.html) for current implementation details.

## 1.3 Color Schemes & the Lumina Colors Engine

Lumina's color schemes offer distinct expressions of the theme's visual identity while sharing semantic color roles:

* **Elements (standard):** Sage green, ocean blue, and golden sun create a nature-inspired balance of flora, water, and warmth.
* **Horizon (standard):** Coastal terracotta, ocean blue, and golden sun bring an earthy, open feeling shaped by land and sea.
* **Heritage (standard):** Patina crimson, burnished brass, and midnight blue evoke the thoughtful richness of a professor's library.
* **Ember (standard):** Fiery terracotta, gold, and volcanic umber give the palette a warm, glowing energy.
* **Velvet (standard):** Plum, sapphire, and crimson jewel tones create a rich and expressive atmosphere.
* **Dusk (standard):** Evening slates and twilight terracotta capture the subdued, contemplative mood of the blue hour.
* **Low Tide (dark):** Deep water, gray stone, and glistening sand suggest a dramatic shoreline after the tide recedes.
* **Zinc (dark):** Machined metal and gunmetal tones give the palette a restrained, industrial character.
* **Light (high-key):** Soft linen amber, ocean slate, and sage linen create an airy, luminous treatment.
* **Lumina Full Palette:** A broad starting palette that exposes the theme's wider range of named colors and semantic roles.

The Lumina Colors Engine and its semantic color registry connect each color role to theme-authored treatments for body text, headings, and links. This gives the theme author control over intended contrast relationships and supports accessible, coherent defaults. Creators should still check contrast when they customize colors and content; the engine does not guarantee WCAG compliance for every possible combination.

See the [theme palette reference](https://nichewp.github.io/lumina/theme.html) for scheme colors and the [theme variables documentation](https://nichewp.github.io/lumina/variables.html) for custom variables.

## 1.4 Typography & Curated Fonts

Lumina's default pairing uses Lato for body text and Raleway for headings. Lato provides a clear, approachable reading voice, while Raleway gives headings a more distinctive, architectural character and establishes visual hierarchy. 

The theme also includes Lora for a more traditional serif voice, Open Sans as an alternate sans-serif, Style Script for decorative accents, and Roboto Mono for technical or code-like text. These additional families give creators more ways to shape a site's personality; they are options rather than required roles. 

See the [theme variables and typography documentation](https://nichewp.github.io/lumina/variables.html).

## 1.5 Ambient Light & Organic Depth

Lumina's visual language follows a consistent direction of light from the upper left. Color-mixed borders, translucent glass surfaces, and gradients suggest softly lit edges and reflections. The Lumina Physics Engine carries this sense of light into depth: objects rest on subtle, natural shadows, then interactive elements designed to move lift from the surface and cast deeper shadows. Together, the highlights, shadows, and motion make surfaces feel tactile and connected to the same organic environment. 

See the [SCSS technical documentation](https://nichewp.github.io/lumina/scss/index.html).

## 1.6 Templates, Template Parts & Block Patterns

Lumina includes a broad collection of templates, template parts, and block patterns so creators can shape the whole site, not just its colors and typography. Templates provide page-level starting points; template parts make shared areas such as headers and footers reusable; and patterns offer ready-to-insert sections and page compositions. Creators can adapt these building blocks in the Site Editor to suit their content and brand.

 Explore the documentation for [templates](https://nichewp.github.io/lumina/templates.html), [template parts](https://nichewp.github.io/lumina/parts.html), and [block patterns](https://nichewp.github.io/lumina/patterns.html).
  
# Section 2: Lumina Color Engine & Palette Guide

## 2.1 Guidelines for Standard Schemes

In the standard schemes, primary, secondary, and tertiary colors provide the stronger brand accents used in hero sections, calls to action, and feature areas. Their alternate colors offer a deeper or more emphatic companion. Subtle colors create quieter surfaces for grouped content, feature icons, galleries, and pricing cards. Neutral colors support the page canvas, supporting sections, dividers, and other structural details.

The following lightness ranges describe the current palettes as a guide, not fixed requirements. Individual schemes vary to preserve their character, and the role of a color matters more than matching a number:

* **Primary, secondary, and tertiary:** Usually around 30-50% lightness, with many values in the 40s; `*-alt` companions are often around 18-38%. Heritage and Dusk use some notably deeper main accents.
* **Subtle surfaces:** Commonly around 91-92%; the less common `*-subtle-alt` colors are closer to 83-84%.
* **Deep accents:** `primary-dark`, `dark`, and `tertiary-dark` roles are generally around 18-28%, with their `*-alt` companions often around 12-20%.
* **Highlights:** `highlight` and `highlight-accent` colors are usually around 68-78%; their alternate colors are generally deeper, around 28-38%.
* **Neutrals:** `base` and `off-white` are typically around 96-99%, with `neutral` surfaces around 88-95%. The gray roles span from light structural tones through mid-grays to dark text and surface anchors.
* **Extended named hues:** In the Full Palette, saturated color anchors are commonly around the 40s, lighter companions around the 80s to low 90s, and darker companions from the 20s to upper 30s. Blue and midnight-blue anchors are some of the darker exceptions.

Choose colors for their role in the composition, then check that text and links remain clear against the selected surface.

## 2.2 Dark and Light Scheme Guidelines

The dark schemes shift the canvas and supporting surfaces into deeper tones, while light foreground colors and distinct accents maintain hierarchy. Their base and subtle surfaces are generally around 10-27% lightness, while contrast text and off-white roles remain near the high end of the range. Highlights stay luminous, and deeper accents provide separation between dark sections. Use changes in surface depth to distinguish content, and keep text and links legible against each chosen background.

The Light scheme takes the opposite approach: its primary, secondary, and tertiary colors become soft, high-key fills, generally around 85-91%, with alternate colors around 80-87% and subtle surfaces around 93-95%. Deeper colors, generally around 34-48%, remain available for prominent actions and contrast. These differences preserve the airy character of the scheme without losing visual anchors.

Treat these ranges as observations and design guidance rather than thresholds. Hue, neighboring colors, and the intended text treatment all affect the result; verify contrast in context.

## 2.3 Color Roles in Lumina Patterns

Lumina's patterns demonstrate how the semantic palette can establish hierarchy across real layouts. The examples below describe common uses, not rules that every pattern must follow.

| Color role | Related color slugs | How it appears in patterns | Design guidance |
| --- | --- | --- | --- |
| Primary (`primary`) | `primary-alt`, `primary-subtle`,  `primary-dark`, `primary-dark-alt` | Brand-forward hero areas, featured sections, and calls to action. | Use to establish a clear focal point or support a primary action; use the related shades to vary emphasis and surface weight. |
| Secondary (`secondary`) | `secondary-alt`, `secondary-subtle` | Alternate call-to-action sections, media-and-text panels, and supporting content bands. | Use to distinguish a related section or secondary action from the primary focal point. |
| Tertiary (`tertiary`) | `tertiary-alt`, `tertiary-subtle`,  `tertiary-dark`, `tertiary-dark-alt` | Accent details, social and feature columns, and separator rules in pricing layouts. | Use selectively to add contrast and rhythm without making every section compete for attention. |
| Dark anchors | `dark`, `dark-alt`, `primary-dark`, `primary-dark-alt`, `tertiary-dark`, `tertiary-dark-alt` | Dark call-to-action panels and other intentionally dramatic sections. | Pair deeper surfaces with suitable light foreground colors and verify contrast in context. |
| Highlights and link accents | `highlight`, `highlight-alt`, `highlight-accent`, `highlight-accent-alt`, `highlight-accent-2`, `highlight-accent-2-alt` | Link treatments and emphasized statistics or values. | Reserve brighter accents for useful emphasis, and retain clear text contrast. |
| Neutral foundation | `base`, `contrast`, `neutral`, `neutral-alt`, `off-white`, `white`, `black`, `very-light-gray`, `light-gray`, `gray`, `dark-gray`, `very-dark-gray`, `almost-black`, `not-quite-black` | Page backgrounds, body and heading text, supporting surfaces, and dividers. | Use these roles as the visual foundation that keeps content readable and color accents organized. |
| Green family | `very-light-green`, `light-green`, `green`, `dark-green`, `bright-green`, `dark-bright-green` | Available for creator-selected accents and custom pattern compositions; the curated patterns primarily express color through the semantic roles above. | Choose a green by its role and contrast, rather than assuming a named hue is suitable for every text or surface use. |
| Yellow family | `very-light-yellow`, `light-yellow`, `yellow`, `dark-yellow` | Available for creator-selected accents and custom pattern compositions. | Use lighter variants for restrained fills and stronger variants for intentional accents; check foreground contrast. |
| Orange family | `very-light-orange`, `light-orange`, `orange`, `dark-orange` | Available for creator-selected accents and custom pattern compositions. | Use as a warm accent or supporting fill without letting it compete with primary actions. |
| Blue family | `very-light-blue`, `light-blue`, `blue`, `dark-blue`, `midnight-blue`, `dark-midnight-blue` | Available for creator-selected accents and custom pattern compositions. | Use the lighter tones for soft surfaces and deeper tones for stronger anchors; check text and link contrast. |
| Purple family | `very-light-purple`, `light-purple`, `purple`, `dark-purple` | Available for creator-selected accents and custom pattern compositions. | Use to add a distinct supporting accent while keeping the overall hierarchy clear. |
| Red family | `very-light-red`, `light-red`, `red`, `dark-red` | Available for creator-selected accents and custom pattern compositions. | Use deliberately for emphasis and keep essential meaning available through text or other cues as well. |

## 2.4 Using Color with Intent

Start with the purpose of a section—such as a primary action, a supporting feature, or a quiet content well—and choose a semantic color role to match. Lumina's curated editor palette and patterns provide consistent starting points, while creators remain free to adapt them. When using custom colors or importing patterns from another theme, review text and link contrast in context; color alone should not carry essential meaning.

For exact palette values, see the [theme design tokens reference](https://nichewp.github.io/lumina/theme.html); for custom variables, see the [technical variables documentation](https://nichewp.github.io/lumina/variables.html).

# Section 3: Digital Physics & Kinetic Effects Engine

Lumina's Physics Engine gives interactive elements a shared sense of weight and depth. Its central block registry determines which WordPress blocks participate, what role each block plays, and where an interaction begins and takes effect. That structure lets a card lift as one object while a linked image can move or zoom within its own frame, without applying the same effect indiscriminately to every block.

## 3.1 The Block Registry & Physical Roles

Registry entries use the block's type and context, its relevant style or background, and the presence of a link or control to decide whether it should receive an effect. They also distinguish the element that triggers an interaction from the element that visually responds.

| Role | Typical use | Interaction intent |
| --- | --- | --- |
| Card | Linked or otherwise actionable content containers, such as featured groups and layout sections. | Treat the container as one object, with its resting frame and active feedback kept together. |
| Object | Standalone linked images and featured media. | Give the media a restrained sense of lift when it is actionable. |
| Object-zoom | Images inside columns or Media & Text layouts. | Keep the outer frame steady while the image responds within a clipped viewport. |
| Object-grow | An available role for selected media treatments. | Emphasize an image with in-place growth rather than a change in position. |
| Button | Buttons and other direct controls, including selected social and utility links. | Make the action feel distinct from the surrounding content. |

The registry makes these behaviors explicit and keeps them consistent: blocks that are not configured as actionable objects or containers do not receive kinetic feedback simply because they contain an image or text.

## 3.2 Resting & Interactive States

Lumina separates the baseline appearance from interaction feedback into two stylesheets:

* **`theme-engine.css`** establishes the resting state: frame and border treatment, resting shadows, and the transitions that prepare an eligible object to move.
* **`theme-interactions.css`** supplies hover and keyboard-focus responses. Eligible cards and media lift from the page while their appropriate frame or image shadow deepens, making the change in elevation visible.

The two states follow Lumina's consistent upper-left light direction. Resting shadows ground objects on the page; the deeper interactive shadow suggests that an object has lifted toward the viewer. Framed zoom interactions keep the frame steady while the image responds inside it.

## 3.3 Rounding Exceptions & Layout Brakes

Some layout elements are deliberately excluded from engine-authored rounding. In particular, `.wp-block-media-text__media` and `.wp-block-media-text__content` are parts of a larger split layout; adding independent rounded frames to those children could create competing corners or disrupt the relationship between the image and text. The engine therefore omits its frame and radius rules where the layout itself should control the shape.

Layout brakes handle a different situation: they identify elements inside composite layouts that need a modified frame treatment. They are expressed as CSS selector patterns, such as `.wp-block-media-text *` and `.is-style-no-gap *`, because the relevant context can contain different kinds of child blocks. A list of individual block names would not capture that shared parent-and-descendant relationship.

When a generated target matches a layout brake, the engine avoids treating it like a separate rounded card: braked cards use an inset treatment, while braked image frames omit the standalone outer rounding and shadow. This preserves edge-to-edge and tightly composed layouts without removing their intended interaction feedback.

## 3.4 The Veto Engine & Nested Cards

When cards, images, and other objects are nested, the veto engine prevents their effects from piling up. A card inside another card is silenced as a separate card: its own transform and shadow are suppressed, so the outer card remains the single interactive surface. The companion card-interaction logic also prevents a nested card from becoming a second independent click target.

Embedded images receive a more selective veto. Their resting shadows are removed so they do not cast a second shadow inside the parent card; the engine also suppresses competing image shadows during interaction while allowing an intentional image zoom to continue. This keeps the parent card's depth clear without flattening every effect inside it.

## 3.5 Link-Destination Overlays, Accessibility & Creator Control

For eligible interactive cards, a small overlay icon appears on hover, keyboard focus, or touch activation. The interaction logic examines the card's link or button destination and chooses a visual cue for the action:

* **Scroll up or scroll down:** The target is an anchor elsewhere on the current page; the cue reflects whether that content is above or below the card.
* **View page:** The target is another page on the same site.
* **External link:** The target is on another site.

The overlay is a visual hint, not a replacement for the underlying link or button. The engine also respects the operating system's reduced-motion preference, and the theme offers static or quieter treatments for creators who want less movement.

The physics configuration separates development output from visual debugging. `$lumina-dev-mode` defaults to off, using shared placeholder rules for production-oriented output; turning it on emits more distinct declarations that are easier to trace while developing. The independent `$lumina-debug` switch adds outlines for registry roles, wrappers, and veto boundaries. It also defaults to off, so debug outlines are not enabled in normal use.

For the registry, selector, state, veto, and accessibility implementation details, see the [SCSS technical documentation](https://nichewp.github.io/lumina/scss/index.html). The [block pattern catalog](https://nichewp.github.io/lumina/patterns.html) shows how these behaviors support real page compositions.

# Section 4: WordPress Standards & Code Conventions

Lumina is built to work with WordPress rather than around it. The theme favors native block-theme settings, editor controls, templates, and APIs where they meet the need, and adds custom behavior only where it provides a clear benefit. These conventions describe how new work should be approached; they are not a claim that every existing file has passed a comprehensive automated standards audit.

## 4.1 WordPress-Native Development

Use WordPress's theme and block systems as the foundation for site structure and presentation. Prefer core settings, styles, block supports, templates, and patterns over parallel custom controls. When custom behavior is needed, integrate through documented WordPress APIs and preserve the expected behavior of the Block Editor and front end.

Keep theme choices adaptable: use semantic settings and presets rather than hard-coding values into each pattern, and make sure changes remain understandable to creators using the Site Editor.

## 4.2 Conventions by Code Area

WordPress Coding Standards apply specifically to PHP. Other parts of the theme should follow the conventions and tools appropriate to their language while supporting the same goals of compatibility, security, accessibility, and maintainability.

| Area | Project convention | Why it matters |
| --- | --- | --- |
| PHP | Follow WordPress coding patterns for hooks, APIs, formatting, and output escaping. Validate or sanitize data at input boundaries, and use the project's namespace or prefixes for new global symbols. | Reduces conflicts and helps protect content and settings as they move through WordPress. |
| JavaScript | Keep behavior scoped, avoid unnecessary globals, and use WordPress-compatible handling when using jQuery. Preserve native links and controls, and account for keyboard, touch, and dynamically rendered content where relevant. | Keeps interactions predictable and avoids replacing behavior that WordPress or the browser already provides. |
| SCSS and CSS | Use Sass modules, follow the project's WordPress-based Stylelint conventions, and prefer scoped selectors and theme tokens. Avoid `!important` as a routine specificity tool, but use deliberate overrides when WordPress markup or styles require them. | Keeps styles composable across blocks, editor contexts, and theme variations. |
| `theme.json` and block-theme content | Keep configuration compatible with the WordPress theme schema; distinguish available editor settings from their default styles, and use reusable presets and semantic roles. | Keeps creator-facing controls consistent and helps patterns transfer cleanly through the Site Editor. |

## 4.3 Accessibility, Security & Compatibility

Treat accessible interaction and safe data handling as part of implementation, not a final polish pass. Use semantic markup and controls, maintain keyboard operation and visible focus, respect reduced-motion preferences, and do not rely on color alone to convey meaning. For PHP and client-side behavior, validate data before use and escape or encode values appropriately when rendering them.

Custom styles and scripts should complement WordPress's editor and front-end behavior. Test changes in the context where creators and visitors will encounter them, especially when they affect block controls, responsive layouts, or interactive content.

## 4.4 Validation & Ongoing Compliance

The repository includes a Stylelint configuration based on WordPress's SCSS rules and build tooling for compiling the theme styles. The current project scripts do not define a dedicated PHP_CodeSniffer/WPCS command or a comprehensive automated test gate. A successful build is useful, but it does not by itself establish PHP standards compliance, accessibility, or correct behavior in WordPress.

Use the available style and build checks for the code they cover, and review changes in the editor and front end as appropriate. The conventions above are the contribution standard; any automated checks should be described only for the areas they actually verify.
