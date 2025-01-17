export default function Navbar({ onOpen }) {
    const handleRefresh = () => {
        window.location.reload();  
    };

    return (
        <>
            <div className="navbar bg-base-100">
                <div className="navbar-start">
                    <button 
                        onClick={handleRefresh} 
                        className="btn btn-button text-xl bg-neutral btn-ghost"
                    >
                        DataManager
                    </button>
                </div>
                <div className="navbar-center">
                    <div className="form-control">
                        <input type="text" placeholder="Search" className="input input-bordered w-48 md:w-auto" />
                    </div>
                </div>
                <div className="navbar-end">
                    <button onClick={onOpen} className="btn btn-primary">Add Siswa</button>
                </div>
            </div>
        </>
    );
}
