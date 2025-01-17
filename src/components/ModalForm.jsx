import { useState, useEffect } from "react";

export default function ModalForm({ isOpen, onClose, mode, onSubmit, item }) {
    const [telephone, setTelephone] = useState('');
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [username, setUsername] = useState('');
    const [status, setStatus] = useState('');

    useEffect(() => {
      if (mode === 'edit' && item) {
        setName(item.name);
        setEmail(item.email);
        setUsername(item.username);
        setTelephone(item.telephone);
        setStatus(item.status); 
      } else {
        setName('');
        setEmail('');
        setUsername('');
        setTelephone('');
        setStatus('');  
      }
    }, [mode, item, isOpen]);

    const handleInputChange = (e) => {
      const { name, value } = e.target;
      if (name === 'telephone') setTelephone(value);
      if (name === 'name') setName(value);
      if (name === 'email') setEmail(value);
      if (name === 'username') setUsername(value);
      if (name === 'status') setStatus(value); 
    };

    const handleSubmit = (e) => {
      e.preventDefault();
      const formData = { name, email, username, telephone, status }; 
      onSubmit(formData);  
    };

    return (
        <>  
            <dialog id="my_modal_3" className="modal bg-black/40" open={isOpen}>
                <div className="modal-box">
                    <button className="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" onClick={onClose}>✕</button>
                    <h3 className="font-bold text-lg py-4">{mode === 'edit' ? 'Edit Client' : 'Add Client'}</h3>
                    <form onSubmit={handleSubmit}>
                        <label className="input input-bordered flex items-center my-4 gap-2">
                            Name 
                            <input type="text" name="name" className="grow" value={name} onChange={handleInputChange}/>
                        </label>
                        <label className="input input-bordered flex items-center my-4 gap-2">
                            Email 
                            <input type="text" name="email" className="grow" value={email} onChange={handleInputChange} />
                        </label>
                        <label className="input input-bordered flex items-center my-4 gap-2">
                            Username 
                            <input type="text" name="username" className="grow" value={username} onChange={handleInputChange}/>
                        </label>

                        <div className="flex mb-4 justify-between">
                            <label className="input input-bordered flex mr-4 items-center gap-2">
                                Telephone
                                <input type="text" name="telephone" className="grow" value={telephone} onChange={handleInputChange}/>
                            </label>

                            <select className="select select-bordered w-full max-w-xs" name="status" value={status} onChange={handleInputChange}>
                                <option value="Inactive">Inactive</option>
                                <option value="Active">Active</option>
                            </select>
                        </div>

                        <button type="submit" className="btn btn-success">{mode === 'edit' ? 'Save Changes' : 'Add Client'}</button>
                    </form>
                </div>
            </dialog>
        </>
    );
}
