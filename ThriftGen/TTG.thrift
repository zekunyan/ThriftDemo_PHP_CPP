namespace cpp TTG
namespace php TTG

enum ResponseState {
    StateOk = 0,
    StateError = 1,
    StateEmpty = 2
}

struct Request {
    1: i32 studentID = 0
}

struct Response {
    1: i32 studentID = 0,
    2: string name,
    3: list<string> infos,
    4: ResponseState state
}

service TTGService {
    Response getStudentInfo(1: Request request);
}
