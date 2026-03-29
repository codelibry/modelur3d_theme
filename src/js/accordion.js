/**
 * Accordion Component
 *
 * - Keyboard accessible (Enter / Space to toggle, Arrow keys to navigate).
 * - ARIA attributes updated on toggle (aria-expanded, hidden).
 * - Supports multiple independent accordions on the same page.
 * - Only one item open at a time per accordion (configurable).
 */

const SELECTORS = {
    accordion : '.accordion',
    item      : '.accordion-item',
    header    : '.accordion-header',
    content   : '.accordion-content',
};

const CLASSES = {
    active: 'active',
};

function toggleItem( item, forceOpen ) {
    const header  = item.querySelector( SELECTORS.header );
    const content = item.querySelector( SELECTORS.content );

    if ( ! header || ! content ) return;

    const willOpen = forceOpen !== undefined ? forceOpen : ! item.classList.contains( CLASSES.active );

    item.classList.toggle( CLASSES.active, willOpen );
    header.setAttribute( 'aria-expanded', String( willOpen ) );

    if ( willOpen ) {
        content.removeAttribute( 'hidden' );
    } else {
        // Wait for CSS transition before hiding from accessibility tree.
        const onTransitionEnd = () => {
            if ( ! item.classList.contains( CLASSES.active ) ) {
                content.setAttribute( 'hidden', '' );
            }
            content.removeEventListener( 'transitionend', onTransitionEnd );
        };
        content.addEventListener( 'transitionend', onTransitionEnd );
    }
}

function initAccordion( accordion, options = {} ) {
    const { allowMultiple = false } = options;

    const items = [ ...accordion.querySelectorAll( SELECTORS.item ) ];

    items.forEach( ( item ) => {
        const header = item.querySelector( SELECTORS.header );
        if ( ! header ) return;

        header.addEventListener( 'click', () => {
            const isOpen = item.classList.contains( CLASSES.active );

            if ( ! allowMultiple ) {
                // Close all siblings first.
                items.forEach( ( sibling ) => {
                    if ( sibling !== item ) {
                        toggleItem( sibling, false );
                    }
                } );
            }

            toggleItem( item, ! isOpen );
        } );

        header.addEventListener( 'keydown', ( e ) => {
            const headers = items
                .map( ( i ) => i.querySelector( SELECTORS.header ) )
                .filter( Boolean );

            const currentIndex = headers.indexOf( header );

            switch ( e.key ) {
                case 'ArrowDown': {
                    e.preventDefault();
                    const next = headers[ currentIndex + 1 ] ?? headers[ 0 ];
                    next.focus();
                    break;
                }
                case 'ArrowUp': {
                    e.preventDefault();
                    const prev = headers[ currentIndex - 1 ] ?? headers[ headers.length - 1 ];
                    prev.focus();
                    break;
                }
                case 'Home': {
                    e.preventDefault();
                    headers[ 0 ]?.focus();
                    break;
                }
                case 'End': {
                    e.preventDefault();
                    headers[ headers.length - 1 ]?.focus();
                    break;
                }
                default:
                    break;
            }
        } );
    } );
}


export function initAccordions( root = document, options = {} ) {
    const accordions = [ ...root.querySelectorAll( SELECTORS.accordion ) ];
    accordions.forEach( ( accordion ) => initAccordion( accordion, options ) );
}

document.addEventListener( 'DOMContentLoaded', () => {
    initAccordions( document, {
        allowMultiple: false, 
    } );
} );