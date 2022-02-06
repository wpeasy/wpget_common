import '../scss/admin.scss'

/*
Using import() syntax to force creation of separate chunks via Webpack.
 */

async function getWPRocket(){
    const {default: _} = await import('./partials/wp-rocket-admin');
    return 'WPGet Loaded WP Rocket';
}

getWPRocket().then(result => {
    console.info(result);
})

async function getSplitCharacters(){
    const {default: _} = await import('./partials/split-characters');
    return 'WPGet Loaded Split Characters';
}
getSplitCharacters().then( result => {
    console.info(result);
})