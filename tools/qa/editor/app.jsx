import { createRoot, useState } from '@wordpress/element';
import { BlockEditorProvider, BlockCanvas, BlockList } from '@wordpress/block-editor';
import { registerCoreBlocks } from '@wordpress/block-library';
import { parse } from '@wordpress/blocks';

registerCoreBlocks();
const styles = [ { css: window.GLOBAL_CSS }, { css: window.THEME_CSS } ];
const settings = {
	styles,
	__experimentalFeatures: { layout: { contentSize: '46rem', wideSize: '75rem' }, useRootPaddingAwareAlignments: false },
	supportsLayout: true,
};
function App() {
	const [ blocks, setBlocks ] = useState( () => parse( window.CONTENT ) );
	return (
		<BlockEditorProvider value={ blocks } onInput={ setBlocks } onChange={ setBlocks } settings={ settings }>
			<BlockCanvas height="100vh" styles={ styles } />
		</BlockEditorProvider>
	);
}
createRoot( document.getElementById( 'root' ) ).render( <App /> );
window.__invalid = () => parse( window.CONTENT ).filter( ( b ) => b.name && ! b.isValid ).length;
