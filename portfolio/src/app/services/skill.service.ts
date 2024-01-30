import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import Response from '../models/Response';
import Skill from '../models/Skill';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class SkillService {

  constructor(private http:HttpClient) { }

  getskills():Observable<Response<Skill[]>>{
    const url:string = `${environment.urlApi}/api/skill/${environment.userEmail}`
    return this.http.get<Response<Skill[]>>(url)
  }

}
