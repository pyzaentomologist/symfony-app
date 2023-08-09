import React from "react";

export default function List(props) {
  return (
    <ol className="text-lg list-decimal list-inside space-y-4">
      {props.users.map((user, index) => {
        return (
          <li key={index} className="border p-4 rounded-lg shadow-md">
            {user.username}
            <div className="flex justify-between items-center">
              <a
                href={`/admin/${user.id}`}
                className="text-blue-500 hover:underline"
              >
                Edytuj {user.id}
              </a>
              <button
                onClick={() => props.handleDelete(user.id, user.username)}
                className="ml-4 px-2 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none"
              >
                Usuń
              </button>
            </div>
          </li>
        );
      })}
    </ol>
  );
}
