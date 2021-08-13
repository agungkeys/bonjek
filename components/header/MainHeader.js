import Navbar from "./Navbar";
export default function MainHeader(props) {
  const {q, filter, queryParams} = props;
  return (
    <Navbar q={q} filter={filter} queryParams={queryParams} />
  )
}
