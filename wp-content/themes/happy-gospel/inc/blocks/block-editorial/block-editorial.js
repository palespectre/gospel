( function( editor, components, i18n, element ) {
	var el = element.createElement;
	var registerBlockType = wp.blocks.registerBlockType;
	var RichText = wp.editor.RichText;
	var BlockControls = wp.editor.BlockControls;
	var MediaUpload = wp.editor.MediaUpload;
	var InspectorControls = wp.editor.InspectorControls;
	var TextControl = wp.components.TextControl;

	registerBlockType( 'ec/block-editorial', { // Nom du bloc
		title: i18n.__( 'Bloc éditorial' ), // Titre du bloc
		description: i18n.__( 'Un bloc personnalisable.' ), // Description du bloc
		icon: 'businessman', // Icone du bloc
		category: 'common', // Catégorie wordpress dans laquelle se trouvera le bloc
		attributes: { // Elements du bloc
			title: {
				type: 'array',
				source: 'children',
				selector: 'h3',
			},
			paragraph: {
				type: 'array',
				source: 'children',
				selector: 'p',
			},
			mediaID: {
				type: 'number',
			},
			mediaURL: {
				type: 'string',
				source: 'attribute',
				selector: 'img',
				attribute: 'src',
			},
            text: {
                type: 'array',
                source: 'children',
                selector: '.colored-div'
            },
			buttonText: {  //Button text for the desired action
				type: 'string',
			},
			buttonURL: {  //Destination URL when button is clicked
				type: 'url',
			},
		},

		edit: function( props ) {

			var attributes = props.attributes;

			var onSelectImage = function( media ) {
				return props.setAttributes( {
					mediaURL: media.url,
					mediaID: media.id,
				} );
			};

			return [
				el( BlockControls, { key: 'controls' }, // Affiche la barre de contrôles quand on clique sur le bloc
					el( 'div', { className: 'components-toolbar' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							render: function( obj ) {
								return el( components.Button, {
									className: 'components-icon-button components-toolbar__control',
									onClick: obj.open
									},
									el( 'svg', { className: 'dashicon dashicons-edit', width: '20', height: '20' },
										el( 'path', { d: "M2.25 1h15.5c.69 0 1.25.56 1.25 1.25v15.5c0 .69-.56 1.25-1.25 1.25H2.25C1.56 19 1 18.44 1 17.75V2.25C1 1.56 1.56 1 2.25 1zM17 17V3H3v14h14zM10 6c0-1.1-.9-2-2-2s-2 .9-2 2 .9 2 2 2 2-.9 2-2zm3 5s0-6 3-6v10c0 .55-.45 1-1 1H5c-.55 0-1-.45-1-1V8c2 0 3 4 3 4s1-3 3-3 3 2 3 2z" } )
									)
								);
							}
						} )
					),
				),
				el( 'div', { className: 'backoffice-bloc' },
					el( 'div', {
						className: attributes.mediaID ? 'backoffice-profile-image image-active' : 'backoffice-profile-image image-inactive'
					},
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: attributes.mediaID,
							render: function( obj ) {
								return el( components.Button, {
									className: attributes.mediaID ? 'image-button' : 'button button-large',
									onClick: obj.open
									},
									! attributes.mediaID ? i18n.__( 'Upload Image' ) : el( 'img', { src: attributes.mediaURL } )
								);
							}
						} ),
					),
					el( 'div', {
						className: 'backoffice-profile-content'},
						el( RichText, {
							tagName: 'h3',
							placeholder: 'Titre du bloc',
							keepPlaceholderOnFocus: true,
							value: attributes.title,
							isSelected: false,
							onChange: function( newTitle ) {
								props.setAttributes( { title: newTitle } );
							},
						} ),
						el( RichText, {
							tagName: 'p',
							placeholder: i18n.__( 'Contenu du paragraphe...' ),
							keepPlaceholderOnFocus: true,
							value: attributes.paragraph,
							onChange: function( newParagraph ) {
								props.setAttributes( { paragraph: newParagraph } );
							},
						} ),
                        el( 'div', { className: 'button-container' },
                            el( editor.RichText, {
                                tagName: 'span',
                                className: 'button-redirection',
                                inline: true,
                                optional: true,
                                placeholder: i18n.__( 'Bouton' ),
                                value: props.attributes.buttonText,
                                onChange: function( newButtonText ) {  props.setAttributes( { buttonText : newButtonText } );  },
                                focus: props.focus,
                                onFocus: props.setFocus,
                            } )
                        ),
					),
				),
				el( editor.InspectorControls, { key: 'inspector' }, // Affiche les options du bloc sur le côté droit
					el( components.PanelBody, {
						title: i18n.__( 'Bouton redirection' ),
						className: 'link-redirection',
						initialOpen: true,
						},
						el( components.SelectControl, {
                            options: [
                                {label: 'page 1', value: 'www.google.fr'},
                                {label: 'page 2', value: 'www.google.fr'}
                            ],
							label: i18n.__( 'Choisissez une page' ),
							value: props.attributes.buttonURL,
							onChange: function( newValue ) {
								props.setAttributes( { buttonURL: newValue } );
							},
						} ),
					),
				),
			];
		},

		save: function( props ) {
			var attributes = props.attributes;
			if (attributes.mediaURL) {
					return (
						el( 'div', {
							className: 'bloc-content'
						},
							el('div', {
								className: 'image-wrapper'
							},
								el( 'div', {
									className: 'organic-profile-image'
								},
									el( 'img', {
										src: attributes.mediaURL
									} ),
			            el( 'div', {
										className: 'colored-div'
									} ),
								),
							),
							el( 'div', {
								className: 'organic-profile-content'
							},
								el( RichText.Content, {
									tagName: 'h3',
									value: attributes.title
								} ),
								el( RichText.Content, {
									tagName: 'p',
									value: attributes.paragraph
								} ),
                el( 'a', {
                   className: 'cta-button',
                   href: attributes.buttonURL,
                    },
                    el( 'span', { }, attributes.buttonText  ),
                ),
							)
						)
					);
			} else {
					return (
						el( 'div', {
							className: 'bloc-content'
						},
							el( 'div', {
								className: 'organic-profile-content no-before'
							},
								el( RichText.Content, {
									tagName: 'h3',
									value: attributes.title
								} ),
								el( RichText.Content, {
									tagName: 'p',
									value: attributes.paragraph
								} ),
								el( 'a', {
									 className: 'cta-button',
									 href: attributes.buttonURL,
										},
										el( 'span', { }, attributes.buttonText  ),
								),
							)
						)
					);
			}

		},
	} );

} )(
	window.wp.editor,
	window.wp.components,
	window.wp.i18n,
	window.wp.element,
);
