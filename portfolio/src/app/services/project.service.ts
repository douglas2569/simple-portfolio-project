import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import Response from '../models/Response';
import { environment } from 'src/environments/environment';
import Project from '../models/Project';

@Injectable({
  providedIn: 'root'
})
export class ProjectService {

  constructor(private http:HttpClient) { }

  getProjects():Observable<Response<Project[]>>{
    const url:string = `${environment.urlApi}/api/project/${environment.userEmail}`
    return this.http.get<Response<Project[]>>(url)
  }

  getProject(id:string|null):Observable<Response<Project>>{
    const url:string = `${environment.urlApi}/api/project/${environment.userEmail}/${id}`
    return this.http.get<Response<Project>>(url)
  }

}
