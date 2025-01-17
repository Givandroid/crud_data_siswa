export default function TableList({ onOpen, tableData, onDelete }) {
  if (!Array.isArray(tableData)) {
    console.error('tableData bukan array:', tableData);
    return <div>Data tidak tersedia</div>;
  }

  return (
    <>
      <div className="overflow-x-auto mt-10">
        <table className="table bg-neutral">
          <thead className="text-center">
            <tr>
              <th></th>
              <th>Name</th>
              <th>Email</th>
              <th>Username</th>
              <th>Telephone</th>
              <th>Status</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody className="hover text-center">
            {tableData.map((item) => (
              <tr key={item.id} className="hover">
                <th>{item.id}</th>
                <td>{item.name}</td>
                <td>{item.email}</td>
                <td>{item.username}</td>
                <td>{item.telephone}</td>
                <td>
                  <button
                    className={`btn rounded-full w-20 ${item.status === 'Active' ? 'btn-primary' : 'border-2 border-primary bg-transparent'}`}
                  >
                    {item.status === 'Active' ? 'Active' : 'Inactive'}
                  </button>
                </td>
                <td>
                  <button className="btn btn-info mr-5" onClick={() => onOpen('edit', item)}>
                    Update
                  </button>
                  <button className="btn btn-error" onClick={() => onDelete(item.id)}>
                    Delete
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </>
  );
}
