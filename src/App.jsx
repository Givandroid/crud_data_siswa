import './App.css';
import Navbar from './components/Navbar';
import TableList from './components/TableList';
import ModalForm from './components/ModalForm';
import { useState, useEffect } from 'react';

function App() {
  const [isOpen, setIsOpen] = useState(false);
  const [modalMode, setModalMode] = useState('add');
  const [tableData, setTableData] = useState([]);
  const [currentItem, setCurrentItem] = useState(null);

  useEffect(() => {
    fetchData();
  }, []);


  const fetchData = async () => {
    const response = await fetch("http://localhost/read.php");
    const data = await response.json();
    setTableData(data);
  };

 
  const addItem = async (newItem) => {
    const response = await fetch('http://localhost/create.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(newItem),
    });
    const data = await response.json();
    console.log(data.message); 
    fetchData();
  };

 
  const updateItem = async (updatedItem) => {
    const response = await fetch('http://localhost/update.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(updatedItem),
    });
    const data = await response.json();
    console.log(data.message);
    fetchData();
  };

  
  const deleteItem = async (id) => {
    const response = await fetch('http://localhost/delete.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ id }),
    });
    const data = await response.json();
    console.log(data.message); 
    fetchData(); 
  };

  const handleOpen = (mode, item = null) => {
    setModalMode(mode);
    setCurrentItem(item);
    setIsOpen(true);
  };

  const handleSubmit = (formData) => {
    if (modalMode === 'add') {
      addItem(formData);
    } else {
      updateItem({ ...formData, id: currentItem.id });
    }
    setIsOpen(false); 
  };

  return (
    <>
      <div className="py-5 px-5">
        <Navbar onOpen={() => handleOpen('add')} />
        <TableList
          onOpen={handleOpen}
          tableData={tableData}
          onDelete={deleteItem} 
        />
        <ModalForm
          isOpen={isOpen}
          onClose={() => setIsOpen(false)}
          mode={modalMode}
          onSubmit={handleSubmit}
          item={currentItem}
        />
      </div>
    </>
  );
}

export default App;
