export default function App() {
    function handleBookSelection(songID) {
        alert("Izvēlēts ID " + songID);
    }
    return (
        <> <Header /> <main className="mb-8 px-2 md:container md:mx-auto"> <Homepage handleSongSelection={handleSongSelection} /> </main> <Footer /> </>)
}

function Homepage({ handleSongSelection }) { return (<> {topSongs.map((song, index) => (<TopSongView song={song} key={song.id} index={index} handleSongSelection={handleSongSelection} />))} </>) }
function Header() {
    return
    (<> <Header /> <main className="mb-8 px-2 md:container md:mx-auto"> <BookPage selectedSongID={selectedSongID} handleSongSelection={handleSongkSelection} handleGoingBack={handleGoingBack} /> </main> <Footer /> </>)
}
function handleBookSelection(SongID) { alert("Izvēlēts ID " + songID); }
function handleGoingBack() { alert("Atgriežamies sākumlapā"); }
const selectedBookID = 3;
function TopSongView({ song, index, handleSongSelection }) { return (<div className="bg-neutral-100 rounded-lg mb-8 py-8 flex flex-wrap md:flex-row"> <div className={`order-2 px-12 md:basis-1/2 ${index % 2 === 1 ? "md:order-1 md:text-right" : ""} `} > <h2 className="mb-4 text-3xl leading-8 font-light text-neutral-900"> {song.name} </h2> <p className="mb-4 text-xl leading-7 font-light text-neutral-900 mb-4"> {song.description ? (song.description.split(' ').slice(0, 16).join(' ')) + '...' : ''} </p> <SeeMoreBtn songID={song.id} handleSongSelection={handleSongSelection} /> </div> <div className={`order-1 md:basis-1/2 ${index % 2 === 1 ? "md:order-2" : ""}`} > <img src={song.image} alt={song.name} className="p-1 rounded-md border border-neutral-200 w-2/4 aspect-auto mx-auto" /> </div> </div>) }
function SeeMoreBtn({ songID, handleSongSelection }) { return (<button className="inline-block rounded-full py-2 px-4 bg-sky-500 hover:bg-sky-400 text-sky-50 cursor-pointer" onClick={() => handleSongSelection(songID)} >Rādīt vairāk</button>) }
function Footer() {
    return (
        <footer className="bg-neutral-300 mt-8">
            <div className="py-8 md:container md:mx-auto px-2">
                M. Abele, VeA, 2026
            </div>
        </footer>
    )
    const topSongs = [
        { "id": 1, "name": "Mesmerizer", },
        { "id": 2, "name": "Cheap Suits", },
    ];
    const selectedSong = {
        "id": 3, "name": " Cheap Suits"
    };
    const relatedSong = [
        { "id": 4, "name": "Stargazer", },
        { "id": 5, "name": "Another Song", },
    ];
}
